/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package assignment2;

/**
 *
 * @author Dean Tucker
 */
public class fishName {
    String first, last, type;
    private static int count = 0;
    
    /**
     *
     * @param firstName
     * @param lastName
     * @param fishType
     */
    public fishName(String firstName,String lastName,String fishType){
    first = firstName;
    last = lastName;
    type = fishType;
    count++;
}

    /**
     *
     * @return
     */
    public String getName(){
        return first + " " + last;
    }

    /**
     *
     * @return
     */
    public String getType(){
        return type;
    }
    
    /**
     *
     * @return
     */
    public int getNumFish(){
        return count;
    }

    /**
     *
     * @param Other
     * @return
     */
    public boolean isSameType(fishName Other){
        return (this.type).equals(Other.type);
    }
 
    public String toString(){

        return first + " " + last + " (" + type + ")";
    }
}