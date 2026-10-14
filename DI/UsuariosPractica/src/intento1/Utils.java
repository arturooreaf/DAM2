package intento1;

import java.util.Scanner;

public class Utils {
    private static final Scanner sc = new Scanner(System.in);
    public static int  readInt(String message){
        System.out.print(message);
        return sc.nextInt();
    }
    public static String readLine(String message){
        System.out.print(message);
        return sc.next();
    }

}
