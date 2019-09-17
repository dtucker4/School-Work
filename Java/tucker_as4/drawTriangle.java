/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tucker_as4;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.Graphics;
import java.awt.Graphics2D;
import javax.swing.JComponent;


public class drawTriangle extends JComponent {
    int[] x,y;
    
    public drawTriangle(int[] xp, int[] yp){
        x = xp;
        y = yp;
       
    }    
  
       
        @Override
        public void invalidate() {

            x = null;
            y = null;

            super.invalidate(); 
        }
    @Override
      public void paintComponent(Graphics g) {
         super.paintComponent(g);   
         Graphics2D g2d = (Graphics2D) g.create();
         System.out.println("paint new triangle");
         //setBackground(Color.ORANGE);  
         g2d.setColor(Color.BLUE);
         g2d.fillPolygon(x, y, 3);
         g2d.dispose();
      }
  } 
  
