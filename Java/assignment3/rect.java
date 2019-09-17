/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assignment3;
import java.awt.Color;
import java.awt.Graphics;
import javax.swing.JComponent;
import javax.swing.JFrame;

/**
 *
 * @author Dean
 */
public class rect extends JComponent {
   
    int w,h,l,x,y;
    public rect(int xpos, int ypos, int width, int height, int length){
        this.w = width;
        this.h = height;
        this.l = length;
        this.x = xpos;
        this.y = ypos;
    }
    public rect(){
        this.w = 50;
        this.h = 100;
        this.l = 100;
        this.x = 10;
        this.y = 10;
    }
    
  public void paint(Graphics g) {
    g.setColor(Color.blue.darker()); 
    g.drawRect (x, y, h, l);
    g.drawRect (x+w, y+w, h, l);
    g.drawLine(x,y,x+w,y+w);
    g.drawLine(x+h,y,x+h+w,y+w);
    g.drawLine(x+h,y+h,x+w+h,y+w+h);
    g.drawLine(x,y+h,x+w,y+w+h);

  }
  
  public static void drawRect(){
    JFrame window = new JFrame();
    window.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    window.setBounds(30, 30, 300, 300);
    window.getContentPane().add(new rect());
    window.setVisible(true);
}
}

