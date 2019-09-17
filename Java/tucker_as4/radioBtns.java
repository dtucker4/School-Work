/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tucker_as4;

import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.ButtonGroup;
import javax.swing.JComponent;
import javax.swing.JRadioButton;

/**
 *
 * @author Dean
 */
public class radioBtns extends JComponent{
    static String mode = "rect";
    public radioBtns(){
      
 
        JRadioButton rect = new JRadioButton("Rect",true);
        JRadioButton tri = new JRadioButton("Traingle");
        
 
        ButtonGroup group = new ButtonGroup();
        group.add(rect);
        group.add(tri);
    
        rect.addActionListener(new ActionListener(){
            @Override
        public void actionPerformed(ActionEvent e) {
             mode = "rect";
         }
     });
        
        tri.addActionListener(new ActionListener(){
            @Override
        public void actionPerformed(ActionEvent e) {
             mode = "tri";
         }
     });
        
        
        
        setLayout(new FlowLayout());
 
        add(rect);
        add(tri);
        
 
    }
    
    public static String getMode(){
        return  mode;
    }
}
