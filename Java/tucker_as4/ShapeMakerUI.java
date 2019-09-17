/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tucker_as4;
import java.awt.Color;
import java.awt.FlowLayout;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.GridLayout;
import java.util.*;  
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import javax.swing.*;

public class ShapeMakerUI extends JPanel {
    int x, y;
    
    ArrayList<Integer> list;
    int[] temp;
    int[] xarr = {0,0,0};
    int[] yarr= {0,0,0};
    int count = 0;
    int x1,x2,y1,y2;
    public ShapeMakerUI() {
        list = new ArrayList<>();
                
        addMouseListener(new MouseAdapter() { 
          @Override
          public void mouseClicked(MouseEvent e) {
              String temp = radioBtns.getMode();          
            
            if(temp.equals("tri")){
               System.out.println("triangle");
               x=e.getX();
               y=e.getY();
               trackClicksTri(); 
            }
            if(temp.equals("rect")){
                System.out.println("rect");
               x=e.getX();
               y=e.getY();
               trackClicksRect();
            }
            }
        });   
    }
    /*
    public void selectDraw(){
        String temp = radioBtns.getMode();  
        if(temp.equals("tri")){
               add(new drawTriangle(xarr, yarr));
            }
         if(temp.equals("rect")){
               add(new drawRectangle(xarr, yarr));
            }
        
    }
*/
    public void trackClicksRect(){
            list.add(x);
            list.add(y);
            count++;
            //System.out.println("mouse clicked!@" + x + " " + y + " count: " + count);
                if (count == 2){
                    setPoints();
                    list.clear();
                    count = 0;
                    setRectPts();
                    repaint();
                    //selectDraw();
                    System.out.println("x1 = " + xarr[0] + " x2 = " + xarr[1]);
                    System.out.println("y1 = " + yarr[0] + " y2 = " + yarr[1]);
                }
              
       
   }
    
    public void setRectPts(){
        x1 = xarr[0];
        x2 = xarr[1];
        y1 = yarr[0];
        y2 = yarr[1];
    }
   public void trackClicksTri(){
            list.add(x);
            list.add(y);
            count++;
            //System.out.println("mouse clicked!@" + x + " " + y + " count: " + count);
                if (count == 3){
                    setPoints();
                    list.clear();
                    count = 0;
                    repaint();
                    //selectDraw();
                    System.out.println("x1 = " + xarr[0] + " x2 = " + xarr[1] + " x3 = " + xarr[2]);
                    System.out.println("y1 = " + yarr[0] + " y2 = " + yarr[1] + " y3 = " + yarr[2]);
                }
              
       
   }

 @Override
      public void paintComponent(Graphics g) {
         super.paintComponent(g);
         
         String temp = radioBtns.getMode();   
         setBackground(Color.BLACK);
            g.setColor(Color.BLUE);
            if(temp.equals("tri")){
               g.fillPolygon(xarr, yarr, 3);
            }
            if(temp.equals("rect")){
              g.fillRect(x1, y1, x2-x1, y2-y1);
            }
        
      }
    public void setPoints(){
         Iterator itr=list.iterator();  
         int c = 0;
         int i = 0;
         int j = 0;
        while(itr.hasNext()){  
            
            if (c%2 == 0){
                xarr[j] = (int) itr.next();
                j++;
                c++;
            }else{
                yarr[i] = (int) itr.next();
                i++;
                c++;
            }
        }  
    }

}



