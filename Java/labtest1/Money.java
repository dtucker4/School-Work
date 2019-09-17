/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package labtest1;

/**
 *
 * @author Dean Tucker
 */
public class Money {
   int dollars, cents;
   
   public Money(int d, int c){
       dollars = d;
       cents = c;
   }
   public Money(int d){
       dollars = d;
       cents = 0;
   }
   public Money(){
       dollars = 0;
       cents = 0;
   }
   public int getDollars(){
       return dollars;
   }
   public int getCents(){
       return cents;
   }
   public void setDollars(int d){
       dollars = d;
   }
   public void setCents(int c){
       cents = c;
   }
   public String toString(){
       String temp = String.valueOf(dollars);
       String temp2 = String.valueOf(cents);
       return temp + "." + temp2;
   }
   public boolean isEqual(Money m1, Money m2){
       if(m1.dollars == m2.dollars && m1.cents == m2.cents)
           return true;
       else return false;
   }
   public Money addTwo(Money m1, Money m2){
       m1.dollars += m2.dollars;
       m1.cents += m2.cents;
       if(m1.cents >= 100){
           m1.dollars += 1;
           m1.cents -=100;
       }   
       return m1;
   }
      public Money subTwo(Money m1, Money m2){
       m1.dollars -= m2.dollars;
       m1.cents -= m2.cents;
       
       if(m1.cents < 0){
          m1.dollars -= 1;
          m1.cents +=100;
       }   
       return m1;
   }
}
