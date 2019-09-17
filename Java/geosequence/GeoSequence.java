package geosequence;

import javax.swing.JOptionPane;

public class GeoSequence {
    private int a, r, e, curr = 0;
    public static void main(String[] args) {
            GeoSequence Geo = new GeoSequence(2,3,1);
    }
    
    //DEFAULT CONSTRUCTOR
    public GeoSequence(){
       a = 0;
       r = 0;
       e = 0;
       
       
    }
    //GEOSEQUENCE CONSTRUCTOR
    public GeoSequence(int a1, int r1, int e1){
        a = a1;
        r = r1;
        e = e1;
        
        
    }
    
    public int getA(){
        return a;
    }
    public int getR(){
        return r;
    }
    public int getE(){
        return e;
    }
    public int setA(){
        String tempA1 = JOptionPane.showInputDialog("Enter a value for A: ");
        int tempA2 = Integer.parseInt(tempA1);
        return tempA2;
    }
    public int setR(){
        String tempR1 = JOptionPane.showInputDialog("Enter a value for R: ");
        int tempR2 = Integer.parseInt(tempR1);
        return tempR2;
    }
    public int setE(){
        String tempE1 = JOptionPane.showInputDialog("Enter a value for E: ");
        int tempE2 = Integer.parseInt(tempE1);
        return tempE2;
    }
    
}
