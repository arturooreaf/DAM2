import java.util.Scanner;

//TIP To <b>Run</b> code, press <shortcut actionId="Run"/> or
// click the <icon src="AllIcons.Actions.Execute"/> icon in the gutter.
public class Calculadora {


    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);


String menu = """
   1.Sumar
   2.Restar
   3.Multiplicar
   4.Dividir
   5.Salir
        """;
        System.out.println(menu);


        System.out.println("Elige que accion quieres realizar (1-5) ");
        int elegirNumero = sc.nextInt();


        System.out.println("Introduce el primer numero: ");
        int numero1 = sc.nextInt();
        System.out.println("Introduce el segundo numero: ");
        int numero2 = sc.nextInt();
        int total = 0;
    if(elegirNumero == 1) {
        total = (numero1 + numero2);
        System.out.println("Suma realizada");
        System.out.println(" Se ha sumado el" + " numero: " + numero1 + " + "  + numero2 + " Y el  resultado de la suma es: " +  total);
    }else if(elegirNumero == 2){
        total = (numero1 - numero2);
        System.out.println("resta realizada");
        System.out.println(" Se ha restado el" + " numero: " + numero1 + " - "  + numero2 + " Y el  resultado de la resta es: " +  total);
    } else if (elegirNumero == 3) {
        total = (numero1 * numero2);
        System.out.println("Multiplicación realizada");
        System.out.println(" Se ha multiplicado el" + " numero: " + numero1 + " * "  + numero2 + " Y el  resultado de la multiplicación es: " +  total);
    } else if (elegirNumero == 4) {
        total = (numero1 / numero2);
        System.out.println("Division realizada");
        System.out.println(" Se ha dividido el" + " numero: " + numero1 + " / " + numero2 + " Y el  resultado de la division es: " +  total);
    }else {
        System.out.println("El programa ha terminadp");
    }

}


    }


