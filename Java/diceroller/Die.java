/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package diceroller;

/**
 *
 * @author Dean Tucker
 */

import java.security.SecureRandom;

public class Die{
    
    public static int getFace(int n){
        SecureRandom randomRoll = new SecureRandom();
         int face = 1+randomRoll.nextInt(n);
         return face;
    }
    
     public static void main(String[] args){
        
        int die1 = getFace(6);
        int die2 = getFace(6);
        int die3 = getFace(6);
        int die4 = getFace(6);
        
        System.out.printf("First Die: %d\nSecond Die: %d\nThird Die: %d \nFourth Die: %d\n"
                , die1,die2,die3,die4);
    }
}
