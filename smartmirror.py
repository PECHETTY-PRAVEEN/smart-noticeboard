# smartmirror.py
# requirements
# requests, feedparser, traceback, Pillow

from tkinter import *
import locale
import threading
import time
import requests
import json
import traceback
import feedparser
from io import BytesIO

from PIL import Image, ImageTk
from contextlib import contextmanager

#from __future__ import print_function
import datetime
#from googleapiclient.discovery import build
##from httplib2 import Http
##from oauth2client import file, client, tools
##import gspread
##from oauth2client.service_account import ServiceAccountCredentials
##SCOPES = 'https://www.googleapis.com/auth/calendar.readonly'

LOCALE_LOCK = threading.Lock()

ui_locale = '' # e.g. 'fr_FR' fro French, '' as default
time_format = 12 # 12 or 24
date_format = "%b %d, %Y" # check python doc for strftime() for options
news_country_code = 'in'
weather_api_token = '3c66b4a127c192d228307b1bf2b80bf3' # create account at https://darksky.net/dev/
weather_lang = 'en' # see https://darksky.net/dev/docs/forecast for full list of language parameters values
weather_unit = 'auto' # see https://darksky.net/dev/docs/forecast for full list of unit parameters values
latitude = 17.0814 # Set this if IP location lookup does not work for you (must be a string)
longitude = 82.0571 # Set this if IP location lookup does not work for you (must be a string)
xlarge_text_size = 60
large_text_size = 40
medium_text_size = 24
small_text_size = 16

@contextmanager
def setlocale(name): #thread proof function to work with locale
    with LOCALE_LOCK:
        saved = locale.setlocale(locale.LC_ALL)
        try:
            yield locale.setlocale(locale.LC_ALL, name)
        finally:
            locale.setlocale(locale.LC_ALL, saved)

# maps open weather icons to
# icon reading is not impacted by the 'lang' parameter
icon_lookup = {
    'clear-day': "assets/Sun.png",  # clear sky day
    'wind': "assets/Wind.png",   #wind
    'cloudy': "assets/Cloud.png",  # cloudy day
    'partly-cloudy-day': "assets/PartlySunny.png",  # partly cloudy day
    'rain': "assets/Rain.png",  # rain day
    'snow': "assets/Snow.png",  # snow day
    'snow-thin': "assets/Snow.png",  # sleet day
    'fog': "assets/Haze.png",  # fog day
    'clear-night': "assets/Moon.png",  # clear sky night
    'partly-cloudy-night': "assets/PartlyMoon.png",  # scattered clouds night
    'thunderstorm': "assets/Storm.png",  # thunderstorm
    'tornado': "assests/Tornado.png",    # tornado
    'hail': "assests/Hail.png"  # hail
}


class Clock(Frame):
    def __init__(self, parent, *args, **kwargs):
        Frame.__init__(self, parent, bg='black')
        # initialize time label
        self.time1 = ''
        self.timeLbl = Label(self, font=('Helvetica', large_text_size), fg="white", bg="black")
        self.timeLbl.pack(side=TOP, anchor=E)
        # initialize day of week
        self.day_of_week1 = ''
        self.dayOWLbl = Label(self, text=self.day_of_week1, font=('Helvetica', small_text_size), fg="white", bg="black")
        self.dayOWLbl.pack(side=TOP, anchor=E)
        # initialize date label
        self.date1 = ''
        self.dateLbl = Label(self, text=self.date1, font=('Helvetica', small_text_size), fg="white", bg="black")
        self.dateLbl.pack(side=TOP, anchor=E)
        self.tick()

    def tick(self):
        with setlocale(ui_locale):
            if time_format == 12:
                time2 = time.strftime('%I:%M %p') #hour in 12h format
            else:
                time2 = time.strftime('%H:%M') #hour in 24h format

            day_of_week2 = time.strftime('%A')
            date2 = time.strftime(date_format)
            # if time string has changed, update it
            if time2 != self.time1:
                self.time1 = time2
                self.timeLbl.config(text=time2)
            if day_of_week2 != self.day_of_week1:
                self.day_of_week1 = day_of_week2
                self.dayOWLbl.config(text=day_of_week2)
            if date2 != self.date1:
                self.date1 = date2
                self.dateLbl.config(text=date2)
            # calls itself every 200 milliseconds
            # to update the time display as needed
            # could use >200 ms, but display gets jerky
            self.timeLbl.after(200, self.tick)


class Weather(Frame):
    def __init__(self, parent, *args, **kwargs):
        Frame.__init__(self, parent, bg='black')
        self.temperature = ''
        self.forecast = ''
        self.location = ''
        self.currently = ''
        self.icon = ''
        self.degreeFrm = Frame(self, bg="black")
        self.degreeFrm.pack(side=TOP, anchor=W)
        self.temperatureLbl = Label(self.degreeFrm, font=('Helvetica', xlarge_text_size), fg="white", bg="black")
        self.temperatureLbl.pack(side=LEFT, anchor=N)
        self.iconLbl = Label(self.degreeFrm, bg="black")
        self.iconLbl.pack(side=LEFT, anchor=N, padx=20)
        self.currentlyLbl = Label(self, font=('Helvetica', medium_text_size), fg="white", bg="black")
        self.currentlyLbl.pack(side=TOP, anchor=W)
        self.forecastLbl = Label(self, font=('Helvetica', small_text_size), fg="white", bg="black")
        self.forecastLbl.pack(side=TOP, anchor=W)
        self.locationLbl = Label(self, font=('Helvetica', small_text_size), fg="white", bg="black")
        self.locationLbl.pack(side=TOP, anchor=W)
        self.get_weather()

    def get_ip(self):
        try:
            ip_url = "http://jsonip.com/"
            req = requests.get(ip_url)
            ip_json = json.loads(req.text)
            return ip_json['ip']
        except Exception as e:
            traceback.print_exc()
            return ("Error: %s. Cannot get ip." % e)

    def get_weather(self):
        try:

            if latitude is None and longitude is None:
                # get location
                location_req_url = "http://freegeoip.net/json/%s" % self.get_ip()
                r = requests.get(location_req_url)
                location_obj = json.loads(r.text)

                lat = location_obj['latitude']
                lon = location_obj['longitude']

                location2 = "%s, %s" % (location_obj['city'], location_obj['region_code'])

                # get weather
                weather_req_url = "https://api.darksky.net/forecast/%s/%s,%s?lang=%s&units=%s" % (weather_api_token, lat,lon,weather_lang,weather_unit)
            else:
                location2 = ""
                # get weather
                weather_req_url = "https://api.darksky.net/forecast/%s/%s,%s?lang=%s&units=%s" % (weather_api_token, latitude, longitude, weather_lang, weather_unit)

            r = requests.get(weather_req_url)
            weather_obj = json.loads(r.text)

            degree_sign= u'\N{DEGREE SIGN}'
            temperature2 = "%s%s" % (str(int(weather_obj['currently']['temperature'])), degree_sign)
            currently2 = weather_obj['currently']['summary']
            forecast2 = weather_obj["hourly"]["summary"]

            icon_id = weather_obj['currently']['icon']
            icon2 = None

            if icon_id in icon_lookup:
                icon2 = icon_lookup[icon_id]

            if icon2 is not None:
                if self.icon != icon2:
                    self.icon = icon2
                    image = Image.open(icon2)
                    image = image.resize((70, 70), Image.ANTIALIAS)
                    image = image.convert('RGB')
                    photo = ImageTk.PhotoImage(image)

                    self.iconLbl.config(image=photo)
                    self.iconLbl.image = photo
            else:
                # remove image
                self.iconLbl.config(image='')

            if self.currently != currently2:
                self.currently = currently2
                self.currentlyLbl.config(text=currently2)
            if self.forecast != forecast2:
                self.forecast = forecast2
#                self.forecastLbl.config(text=forecast2)
            if self.temperature != temperature2:
                self.temperature = temperature2
                self.temperatureLbl.config(text=temperature2)
            if self.location != location2:
                if location2 == ", ":
                    self.location = "Cannot Pinpoint Location"
                    self.locationLbl.config(text="Cannot Pinpoint Location")
                else:
                    self.location = location2
                    self.locationLbl.config(text=location2)
        except Exception as e:
            traceback.print_exc()
            print( "Error: %s. Cannot get weather." % e)

        self.after(600000, self.get_weather)

    @staticmethod
    def convert_kelvin_to_fahrenheit(kelvin_temp):
        return 1.8 * (kelvin_temp - 273) + 32


class News(Frame):
    def __init__(self, parent, *args, **kwargs):
        Frame.__init__(self, parent, *args, **kwargs)
        self.config(bg='black')
        #self.title = 'News' # 'News' is more internationally generic
        #self.newsLbl = Label(self, text=self.title, font=('Helvetica', medium_text_size), fg="white", bg="black")
        #self.newsLbl.pack(side=TOP, anchor=W)
        image = Image.open("assets/pp.png")
        image = image.resize((300, 60), Image.ANTIALIAS)
        image = image.convert('RGB')
        photo = ImageTk.PhotoImage(image)

        self.iconLbl = Label(self, bg='black', image=photo)
        self.iconLbl.image = photo
        self.iconLbl.pack(side=TOP, anchor=W)
        self.headlinesContainer = Frame(self, bg="black")
        self.headlinesContainer.pack(side=TOP)
        
        self.get_headlines()

    def get_headlines(self):
##        scope = ['https://spreadsheets.google.com/feeds','https://www.googleapis.com/auth/drive']
##        creds = ServiceAccountCredentials.from_json_keyfile_name('client_secret.json', scope)
##        client = gspread.authorize(creds)
##        sheet = client.open("hello").sheet1
##        li=sheet.get_all_values()

       
        try:
            # remove all children
            for widget in self.headlinesContainer.winfo_children():
                widget.destroy()
            if news_country_code == None:
                #headlines_url = "https://news.google.com/news?ned=us&output=rss"
                headlines_url = "https://technicalhub.io/TTemp/"
            else:
                #headlines_url = "https://news.google.com/news?ned=%s&output=rss" % news_country_code
                headlines_url = "https://technicalhub.io/TTemp/"

            feed = feedparser.parse(headlines_url)
            target="http://192.168.43.66/my/uploads/"
            r = requests.get('http://192.168.43.66/my/uploads/json_txt.php')
            l=list(r.json())
            #l=['Welcome','Have a good day']
            
            for i in l:
                headline = NewsHeadline(self.headlinesContainer, i)
                headline.pack(side=TOP, anchor=W)


            # for post in feed.entries[0:]:
            #     #headline = NewsHeadline(self.headlinesContainer, post.title)
            #     headline = NewsHeadline(self.headlinesContainer, "Thub Awards on 28th December, 2018")
            #     headline.pack(side=TOP, anchor=W)
        except Exception as e:
            traceback.print_exc()
            print ("Error: %s. Cannot get news." % e)

        self.after(6000, self.get_headlines)


class NewsHeadline(Frame):
    def __init__(self, parent, event_name=""):
        Frame.__init__(self, parent, bg='black')

        image = Image.open("assets/b.png")
        image = image.resize((35, 35), Image.ANTIALIAS)
        image = image.convert('RGB')
        photo = ImageTk.PhotoImage(image)

        self.iconLbl = Label(self, bg='black', image=photo)
        self.iconLbl.image = photo
        self.iconLbl.pack(side=LEFT, anchor=N)

        self.eventName = event_name
        self.eventNameLbl = Label(self, text=self.eventName, font=('Helvetica', small_text_size), fg="white", bg="black")
        self.eventNameLbl.pack(side=LEFT, anchor=N)


class Calendar(Frame):
    def __init__(self, parent, *args, **kwargs):
        Frame.__init__(self, parent, bg='black')
        self.title = 'Image'
        self.num=0
        self.persistent_image = None
        self.calendarLbl = Label(self, text=self.title, font=('Helvetica', small_text_size), fg="white", bg="black")
        self.calendarLbl.pack(side=TOP, anchor=E)
        self.label = Label(self)
        self.label.pack(side="top", fill="both", expand=True)
        # self.calendarEventContainer = Frame(self, bg='black')
        # self.calendarEventContainer.pack(side=TOP, anchor=E)
        self.get_events()

    def get_events(self,delay=2):
        #TODO: implement this method
        # reference https://developers.google.com/google-apps/calendar/quickstart/python

        # remove all children
        target="http://192.168.43.66/my/uploads/"
        r = requests.get('http://192.168.43.66/my/uploads/json.php')
        iml=list(r.json())
        iml=[target+i for i in iml]




        
        #iml=["https://technicalhub.io/img/400x400/Shaifu_certi.jpg","https://technicalhub.io/img/400x400/sudhir_certi.jpg","http://localhost/my/uploads/images.jpeg","http://localhost/my/uploads/1.jpg"]
        myimage = iml[self.num]
        
        self.num = (self.num + 1) % len(iml)
        # response = requests.get(myimage)
        # img_data = response.content
        # photo = ImageTk.PhotoImage(Image.open(BytesIO(img_data)))
        # img=Label(self, image=photo)
        # img.image = photo
        # img.pack(side=LEFT, anchor=N)
        self.showImage(myimage)
        #its like a callback function after n seconds (cycle through pics)
        self.after(delay*1000, self.get_events)
    def showImage(self, filename):
        response = requests.get(filename)
        img_data = response.content
        photo = Image.open(BytesIO(img_data))
        photo=photo.resize((400, 400), resample=Image.ANTIALIAS)
        img_w, img_h = photo.size
        scr_w, scr_h = self.winfo_screenwidth(), self.winfo_screenheight()
        width, height = min(scr_w, img_w), min(scr_h, img_h)
        photo.thumbnail((width, height), Image.ANTIALIAS)

        #set window size after scaling the original image up/down to fit screen
        #removes the border on the image
        scaled_w, scaled_h = photo.size
        #self.wm_geometry("{}x{}+{}+{}".format(scaled_w,scaled_h,0,0))
        
        # create new image 
        self.persistent_image = ImageTk.PhotoImage(photo)
        self.label.configure(image=self.persistent_image)

# class CalendarEvent(Frame):
#     def __init__(self, parent, event_name="Event 1"):
#         Frame.__init__(self, parent, bg='black')
#         image = Image.open("assets/t.png")
#         image = image.resize((35, 35), Image.ANTIALIAS)
#         image = image.convert('RGB')
#         photo = ImageTk.PhotoImage(image)

#         self.iconLbl = Label(self, bg='black', image=photo)
#         self.iconLbl.image = photo
#         self.iconLbl.pack(side=LEFT, anchor=N)
#         self.eventName = event_name
#         self.eventNameLbl = Label(self, text=self.eventName, font=('Helvetica', small_text_size), fg="white", bg="black")
#         self.eventNameLbl.pack(side=TOP, anchor=E)


class FullscreenWindow:

    def __init__(self):
        self.tk = Tk()
        self.tk.configure(background='black')
        self.topFrame = Frame(self.tk, background = 'black')
        self.bottomFrame = Frame(self.tk, background = 'black')
        self.toprightframe=Frame(self.tk,background='black')
        self.topFrame.pack(side = TOP, fill=BOTH, expand = YES)
        self.bottomFrame.pack(side = TOP, fill=BOTH, expand = YES)
        self.toprightframe.pack(sid=TOP,fill=BOTH,expand=YES)
        self.state = False
        self.tk.bind("<Return>", self.toggle_fullscreen)
        self.tk.overrideredirect(True)
        self.tk.geometry("{0}x{1}+0+0".format(self.tk.winfo_screenwidth(), self.tk.winfo_screenheight()))
        self.tk.focus_set()  # <-- move focus to this widget
        self.tk.bind("<Escape>", lambda e: e.widget.quit())
#        self.tk.bind("<Escape>", self.end_fullscreen)
        # clock
        self.clock = Clock(self.topFrame)
        self.clock.pack(side=RIGHT, anchor=N, padx=100, pady=60)
        # weather
        self.weather = Weather(self.topFrame)
        self.weather.pack(side=LEFT, anchor=N, padx=30, pady=40)
        # news
        self.news = News(self.bottomFrame)
        self.news.pack(side=LEFT, anchor=N, padx=30, pady=10)
        # calender - removing for now
        self.calender = Calendar(self.toprightframe)
        self.calender.pack(side = RIGHT, anchor=N, padx=100, pady=7)

    def toggle_fullscreen(self, event=None):
        self.state = not self.state  # Just toggling the boolean
        self.tk.attributes("-fullscreen", self.state)
        return "break"

    def end_fullscreen(self, event=None):
        self.state = False
        self.tk.attributes("-fullscreen", False) 
        return "break" 

if __name__ == '__main__':
    w = FullscreenWindow()
    w.tk.mainloop()
    
