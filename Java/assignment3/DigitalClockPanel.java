/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assignment3;

import java.awt.Font;
import java.awt.Graphics;
import javax.swing.JComponent;
import javax.swing.JFrame;

public class DigitalClockPanel extends JComponent {
      
    @Override
    public void paintComponent(Graphics g)
    {  
        // Draw the enclosing rectangle
        g.drawRect(DigitalClock.x, DigitalClock.y, DigitalClock.width, DigitalClock.height);
  
        // Display the time
        g.setFont(new Font("Monospaced", Font.BOLD, 50));
        g.drawString(DigitalClock.hour + ":" + DigitalClock.minute, 150, 100);
    }
    public static void drawClock(){
    DigitalClock.setTime(10,30);
    JFrame window = new JFrame();
    window.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    window.setBounds(0, 0, 450, 300);
    window.getContentPane().add(new DigitalClockPanel());
    window.setVisible(true);
}
}
