package examen;

import java.util.Scanner;

public class Utils {

    private static Scanner scanner = new Scanner(System.in);

    public static String readString(String message){
        System.out.print(message);
        return scanner.next();
    }

    public static int readInteger(String message){
        System.out.print(message);
        return scanner.nextInt();
    }
}
