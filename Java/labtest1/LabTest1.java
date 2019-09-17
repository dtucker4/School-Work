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
public class LabTest1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
        Money money1 = new Money();
        Money result = new Money();
        System.out.println("Money is: " + money1);

      Money money2 = new Money(5);
      System.out.println("Money is: " + money2);
      Money money2copy = money2;
      Money money3 = new Money(10, 99);
      System.out.println("Money is: " + money3);

      System.out.println("Money1's dollars are: " + money1.getDollars());
      System.out.println("Money1's cents are: " + money1.getCents());

      System.out.println("Changing money1's dollars to 3 dollars.");
      	money1.setDollars(3);
      System.out.println("Money1 is : " + money1.toString());

      System.out.println("Chaning money1's cents to 50 cents.");
        money1.setCents(50);
      System.out.println("Money1 is: " + money1.toString());

      System.out.println("Money1 is equal to money2: " + money1.isEqual(money1, money2));

      //Create a new object called money2copy which is a copy of money2
      
      System.out.println("Money2 is equal to a copy of money2: " + money2copy.toString() );

      //Add money1 and money2, store in result
      
      result = result.addTwo(result, money2);
      System.out.println("Adding money1 and money2: " + result.toString());
      
      result = result.addTwo(result, money3);
      System.out.println("Adding result from above and money3: " + result.toString() );

      money2.subTwo(money2, money1);
      System.out.println("Subtracting money1 from money2: " +  money2.toString() );
      
      money3.subTwo(money3,money1);
      System.out.println("Subtracting money1 from money3: " +  money3.toString() );
     
}
