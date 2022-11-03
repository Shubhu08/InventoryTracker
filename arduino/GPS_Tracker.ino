#include <SoftwareSerial.h>
#include "TinyGPS.h"
#include <Time.h>
#include <TimeAlarms.h>

const int tid = 123;  
float lat,lon; // create variable for latitude and longitude object

unsigned long age, date, time;
SoftwareSerial gpsSerial(4, 5); // create gps sensor connection
TinyGPS gps; // create gps object
 
void setup(){
  Serial.begin(9600); // connect serial
   setTime(12,40,0,3,7,17); // set time
 // create the alarms 
 Alarm.alarmRepeat(12,45,0, sendStatus);  //  every day
  Serial.print("AT\r\n");
  delay(1000);
  Serial.print("AT+SAPBR=3,1,\"Contype\",\"GPRS\"\r\n");
  delay(1000);
  Serial.print("AT+SAPBR=3,1,\"APN\",\"airtelgprs.com\"\r\n");
  delay(1000);
  Serial.print("AT+SAPBR=1,1\r\n");
  delay(1000);  
}
 
void loop(){

  Alarm.delay(0);
  }
  
boolean sendStatus()
{
  gpsSerial.begin(9600); // connect gps sensor
  while(true)
  {while(gpsSerial.available()){  // check for gps data
   if(gps.encode(gpsSerial.read())){ // encode gps data
    gps.f_get_position(&lat,&lon); // get latitude and longitude
    String url=String("AT+HTTPPARA=\"URL\",\"http://trackergps.000webhostapp.com/sendstatus.php?tid=");
    url.concat(tid);
    url.concat("&Lat=");
    url.concat(String(lat,6));
    url.concat("&Lng=");
    url.concat(String(lon,6));
    url.concat("\"\r\n");
    Serial.print("AT+HTTPINIT\r\n");
    delay(1000);
    Serial.print("AT+HTTPPARA=\"CID\",1\r\n");
    delay(1000);
    Serial.print(url);
    delay(1000);
    Serial.print("AT+HTTPACTION=0\r\n");
    delay(1000);
    gpsSerial.end() ;
    return true;
    }
   }   
  }
  return false;
}