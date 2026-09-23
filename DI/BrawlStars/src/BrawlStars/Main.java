package BrawlStars;

import java.util.ArrayList;
import java.util.Scanner;

public class Main {

    // static porque se usan desde el main
    static Scanner sc = new Scanner(System.in);
    // aqui se guardan todos los brawlers que se van creando
    private static ArrayList<Brawler> brawlers = new ArrayList<>();

    public static void main(String[] args) {
        // texto del menu
        String texto = """
                       1. Ver brawlers
                       2. Crear brawler legendario
                       3. Crear brawler épico
                       4. Combatir
                       5. Salir
                       """;

       // se declara fuera del do para que el while la vea
       int opcion;

        // el menu se repite hasta que se elija 5
        do {

            System.out.println(texto);
            System.out.print("OPCION: ");
            // leo la opcion y limpio el salto de linea que deja nextInt
            opcion = sc.nextInt();
           sc.nextLine();
            System.out.println();
            // segun la opcion llamo a lo que toque
            switch (opcion) {
                case 1 -> verBrawlers();
                case 2 -> crearLegendario();
                case 3 -> crearEpico();
                case 4 -> combatir();
            }

            // linea en blanco antes de volver a sacar el menu
            if (opcion != 5) {
                System.out.println();
            }



        } while (opcion != 5);

    }

    // si no hay ninguno lo avisa, si hay los imprime uno a uno
    static void verBrawlers() {
        if (brawlers.isEmpty()) {
            System.out.println("Todavía no hay brawlers creados...");
        } else {
            for (Brawler b : brawlers) {
                // println llama solo al toString
                System.out.println(b); 
            }
        }
    }

    // pide los datos al usuario y mete el legendario en la lista
    static void crearLegendario() {
        System.out.print("Nombre: ");
        String nombre = sc.nextLine();
        System.out.print("Vida: ");
        int vida = sc.nextInt();
        System.out.print("Daño: ");
        int damage = sc.nextInt();
        sc.nextLine(); // limpiar el salto de linea

        brawlers.add(new Legendario(nombre, vida, damage));
    }

    // igual que el legendario pero con suministros en vez de daño
    static void crearEpico() {
        System.out.print("Nombre: ");
        String nombre = sc.nextLine();
        System.out.print("Vida: ");
        int vida = sc.nextInt();
        System.out.print("Suministros: ");
        int suministros = sc.nextInt();
        sc.nextLine();

        brawlers.add(new Epico(nombre, vida, suministros));
    }

    // recorre la lista y devuelve el brawler con ese nombre, o null si no esta
    static Brawler buscarBrawler(String nombre) {
        for (Brawler b : brawlers) {
            if (b.getName().equals(nombre)) {
                return b;
            }
        }
        return null;
    }

    static void combatir() {
        System.out.print("Nombre del brawler 1: ");
        Brawler b1 = buscarBrawler(sc.nextLine());
        System.out.print("Nombre del brawler 2: ");
        Brawler b2 = buscarBrawler(sc.nextLine());

        // si alguno no existe no se puede pelear
        if (b1 == null || b2 == null) {
            System.out.println("Uno de los brawlers no se ha encontrado...");
            return;
        }

        // como estan antes de pelear
        System.out.println(b1);
        System.out.println(b2);
        System.out.println();

        // turno del 1 (cada uno hace su accion segun sea epico o legendario)
        b1.actionByCategory(b2);
        System.out.println(b2);
        System.out.println();

        // turno del 2
        b2.actionByCategory(b1);
        System.out.println(b1);
    }
}
