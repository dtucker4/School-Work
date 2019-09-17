/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assignment2;

/**
 *
 * @author Dean Tucker
 */
public class Date {
    int year,month,day;
    public Date(int d, int m, int y){
        year = y;
        month = m;
        day = d;
    }
    
    public void addDays(int days){
        for(int i = 0; i<= days; i++){
            if(month==4||month==6||month==9||month==11){
                if(day == 30){
                    month++;
                    day = 1;   
                } else day++;
            }
            else if(month == 2 && isLeapYear() == true){
                if(day == 29){
                    month++;
                    day = 1;   
                } else day++;
            }
            else if(month == 2 && isLeapYear() == false){
                if(day == 28){
                    month++;
                    day = 1;   
                } else day++;
            } 
            else if(day == 31){
                    month++;
                    day = 1;   
                }
            else if(month == 12){
                day = 1; 
                month = 1;
                year++;
            }
            else day++;
            
        }
    }
    public void addWeeks(int weeks){
        int days = weeks * 7;
        addDays(days);
        /*
        for(int i = 0; i<= days; i++){
            if(month==4||month==6||month==9||month==11){
                if(day == 30){
                    month++;
                    day = 1;   
                } else day++;
            }
            else if(month == 2 && isLeapYear() == true){
                if(day == 29){
                    month++;
                    day = 1;   
                } else day++;
            }
            else if(month == 2 && isLeapYear() == false){
                if(day == 28){
                    month++;
                    day = 1;   
                } else day++;
            } else if(month == 12){
                day = 1; 
                month = 1;
                year++;
            }
            else{
                if(day == 31){
                    month++;
                    day = 1;   
                } else day++;
            }
        }
        */
    }
    public int daysTo(Date Other){
        int count = 0;
        if(year > Other.year)
            return 0;
        else if(year == Other.year && month > Other.month)
            return 0;
        else if(year == Other.year && month == Other.month && day > Other.day)
            return 0;
        else{
        while(true){
        if (day == Other.day && month == Other.month && year == Other.year){
            System.out.println("There are: " + count + " days until " + Other.toString());
            break;
        }
        else{
            this.addDays(1);
            count++;
        }
        }
        }
        return 0;
    }
    public int getDay(){
        return day;
    }
    public int getMonth(){
        return month;
    }
    public int getYear(){
        return year;
    }
    public boolean isLeapYear(){
        if(year % 4 !=0)
            return false;
        else if(year % 400 == 0)
            return true;
        else if(year % 100 == 0)
            return false;
        else 
            return true;
    }
    public String toString(){
        return getDay() + "/" + getMonth() + "/" + getYear();
    }
}
