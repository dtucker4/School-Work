/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package diceroller;

import java.security.SecureRandom;

/**
 *
 * @author Dean Tucker
 */
public class TwoDice {
    
    public static int die1, die2, sum;
    public int d1, d2;
    public static int rollDice(){
        die1 = getFace(6);
        die2 = getFace(6);
        sum = die1 + die2;
        return sum;
    }
    public TwoDice(){
        
        this.d2 = die2;
    }
    public int getd1(){
        this.d1 = die1;
        return d1;
    }
    public int getd2(){
        this.d2 = die2;
        return d2;
    }
    public static boolean isMatching(int d1, int d2){
        if(d1 == d2)
            return true;
        else 
            return false;
    }
    public static boolean isSnakeEyes(int d1, int d2){
        if(d1 == 1 && d2 == 1)
            return true;
        else return false;
    }
    public static int getFace(int n){
        SecureRandom randomRoll = new SecureRandom();
         int face = 1+randomRoll.nextInt(n);
         return face;
    }
     
    public static void main(String[] args) {
        int n = rollDice();
        
        boolean IsSE, match;
        
        IsSE = isSnakeEyes(die1, die2);
        match = isMatching(die1, die2);
         System.out.printf("Die1: %d, Die2: %d, Sum: %d\n", die1, die2, n);
        if(IsSE == true){
           System.out.printf("You got Snake Eyes!\n");
        }
        if(match == true){
            System.out.printf("You got matching %d's\n", die1);
        }
    }
    
}
