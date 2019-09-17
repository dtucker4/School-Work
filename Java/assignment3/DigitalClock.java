/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assignment3;

import java.util.Random;

public class DigitalClock {
    
    final int hoursInDay = 12;
    final int minutesInHour = 60;
    static int hour, minute,width,height,x,y;
    public DigitalClock(){
        x = 20;
        y = 20;
        width = 345;
        height = 140;
        Random generator = new Random();
        hour = generator.nextInt(hoursInDay + 1);
        minute = generator.nextInt(minutesInHour + 1);
    }
    /*
    public DigitalClock(int h, int m){
        this.hour = h;
        this.minute = m;
    }*/
    static void setTime(int h, int m){
        hour = h;
        minute = m;
    }        
    static void setPos(int xpos, int ypos){
        x = xpos;
        y = ypos;
    }
}
