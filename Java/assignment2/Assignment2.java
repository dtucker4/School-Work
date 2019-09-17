/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assignment2;

import java.io.IOException;
import java.util.logging.Level;
import java.util.logging.Logger;

/**
 *
 * @author Dean Tucker
 */
public class Assignment2 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        testQ1();
        testQ2();
        try {
            testQ3();
        } catch (IOException ex) {
            Logger.getLogger(Assignment2.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    public static void testQ1(){
        //QUESTION 1 Test output
        fishName nemo = new fishName("Nemo", "Finding", "Clownfish");
        fishName bozo = new fishName("Bozo", "Iron", "Clownfish");    
        fishName patrick = new fishName("Patrick", "Star", "Starfish"); 
 
        System.out.println("-------------Question 1 OP----------------");
        System.out.println("Test toString():");
        System.out.println(nemo.toString());
        System.out.println("Test getName(), getType(), getNumFish()");
        System.out.println(nemo.getName());
        System.out.println(nemo.getType());
        System.out.println(nemo.getNumFish());
        System.out.println("Is " + nemo.toString() + " the same type as " + 
                bozo.toString() + "?  "+ nemo.isSameType(bozo));
        System.out.println("Is " + nemo.toString() + " the same type as " + 
                patrick.toString() + "?  "+ nemo.isSameType(bozo));
    }
    public static void testQ2(){
        // Test output for Date Class
        System.out.println("-------------Question 2 OP----------------");
        Date newDate = new Date(2,10,1991);
        Date toDate = new Date(2,10,1998);
        System.out.println(newDate.toString());
        newDate.addDays(31);
        System.out.println(newDate.toString());
        newDate.addWeeks(100);
        System.out.println(newDate.toString());
        newDate.daysTo(toDate); //no output if date 2 is less than date 1
    }
    public static void testQ3() throws IOException{
         System.out.println("-------------Question 3 OP----------------");
        cmpFiles.cmpFiles();
    }
    
}
