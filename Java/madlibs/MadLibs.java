/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package madlibs;
import javax.swing.JOptionPane;
/**
 *
 * @author Dean Tucker
 */
public class MadLibs {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        
         String noun1, noun2, adj, verb;

        noun1 = JOptionPane.showInputDialog("Enter a noun: ");

        noun2 = JOptionPane.showInputDialog("Enter another noun: ");

        adj = JOptionPane.showInputDialog("Enter an adjective: ");
    
        verb = JOptionPane.showInputDialog("Enter a past tense verb: ");
        
        JOptionPane.showMessageDialog(null, "Mary had a little " + noun1 + "\n "
                + "Its " + noun2 + " was " + adj + " as snow\n"
                + "And Everywhere that Mary "+ verb + "\n"
                + "the " + noun1 + " was sure to go");
   
    }
    
}
