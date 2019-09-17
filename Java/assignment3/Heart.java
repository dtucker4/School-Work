
package assignment3;

import java.awt.Color;
import java.awt.Font;
import java.awt.Graphics;
import java.lang.reflect.Field;
import javax.swing.JComponent;
import javax.swing.JFrame;
import javax.swing.JOptionPane;


public class Heart extends JComponent  {

    String getColor(){
        String emotion = JOptionPane.showInputDialog("How are you feeling?");
        if(emotion.equals("love"))
            return "red";
        else if(emotion.equals("anger"))
            return "black";
        else if(emotion.equals("fear"))
            return "orange";
        else if(emotion.equals("joy"))
            return "yellow";
        else if(emotion.equals("sadness"))
            return "blue";
        else if(emotion.equals("suprise"))
            return "green";
        else if(emotion.equals("rage"))
            return "red";
        else return "grey";
    }
    Color setColor(){
        Color color;
        try {
            Field field = Color.class.getField(getColor());
            return color = (Color)field.get(null);
        } catch (Exception e) {
            return color = null; // Not defined
        }
    }
  public void paint(Graphics g) {
    g.setFont(new Font("TimesRoman", Font.PLAIN, 50)); 
    g.setColor(setColor());
    g.drawString("\u2665", 100, 100);

  }
      
    
    public static void drawHeart(){

      JFrame window = new JFrame();
      window.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
      window.setBounds(30, 30, 300, 300);
      window.getContentPane().add(new Heart());
      window.setVisible(true);
  }
    

}
