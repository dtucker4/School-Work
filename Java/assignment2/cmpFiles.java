/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assignment2;
import java.io.*;
/**
 *
 * @author Dean Tucker
 */
public class cmpFiles {

   
    public static void cmpFiles() throws FileNotFoundException, IOException{
  
         BufferedReader input1 = new BufferedReader(new FileReader("data1.txt"));
         BufferedReader input2 = new BufferedReader(new FileReader("data2.txt"));
        String line1;
        String line2;
        int lineNum = 1;
        while((line1 = input1.readLine()) != null)
        {
            line2 = input2.readLine();
            if(line1.equals(line2) == false){
                System.out.println("Error in line: " + lineNum);
                System.out.println(">"+line1);
                System.out.println("<"+line2);
            }
            lineNum++;
        }
        input1.close();
        input2.close();
    }
    
}
