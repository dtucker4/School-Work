/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tucker_as4;

import java.awt.CardLayout;
import java.awt.Color;
import java.awt.*;
import javax.swing.BoxLayout;
import javax.swing.JFrame;
/**
 *
 * @author Dean
 */
public class ShapeMakerFrame{
     JFrame frame = new JFrame();
    public ShapeMakerFrame(){
        ShapeMakerUI sm = new ShapeMakerUI();
        //FlowLayout  experimentLayout = new FlowLayout ();
        frame.setLayout(new BorderLayout());
        frame.add(new radioBtns(), BorderLayout.NORTH);
        frame.add(sm, BorderLayout.CENTER);
          
        
        frame.setSize(500, 500);
	frame.setLocationRelativeTo(null);
	frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
	frame.setVisible(true);
    }
}
