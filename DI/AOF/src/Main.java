//Codigo 178158809  kirfenbr178158809
// 8842

import java.util.ArrayList;

public class Main {
    public static  ArrayList<Vehiculo> vehiculos = new ArrayList<>();
    public static void main(String[] args) {

        Coche coche1 = new Coche("Ford", 430000, "Azul");
        Coche coche2 = new Coche("Opel", 100000, "Verde");
        Coche coche3 = new Coche("BMW", 2000,"Rojo");
        Furgoneta furgoneta = new Furgoneta("Citroen",400000, "comida");
        vehiculos.add(coche1);
        vehiculos.add(coche2);
        vehiculos.add(coche3);
        vehiculos.add(furgoneta);

        int opcion;
        boolean hayvehiculos;

        while(true){
             hayvehiculos = false;
            System.out.println("1. Ver vehiculos\n" + "2. Crear coche\n" + "3. Conducir vehiculo por marca\n" + "4. Salir");
            opcion = Utils.readInt("OPCIÓN: ");
            if(opcion == 4){

                System.out.println("Saliendo... ");
                break;
            }else if(opcion == 1){
                if(vehiculos.size()-1 == 0){
                    System.out.println("No hay vehiculos");
                }else {
                    for (Vehiculo vehiculo : vehiculos){
                        hayvehiculos = true;
                        System.out.print(vehiculo.getMarca() + ": " + vehiculo.getKilometro() + " km\n");
                    }
                }
            } else if (opcion== 2){
                String marca = Utils.readString("Marca del coche: ");
                int kilometro = Utils.readInt("Kilometros del coche");
                String color = Utils.readString("Color: ");
                Coche cochecreado = new Coche(marca, kilometro, color);
                vehiculos.add(cochecreado);


            }else if (opcion == 3){

                    String marcaBuscar = Utils.readString("Marca a Buscar: ");
                    for(Vehiculo vehiculo : vehiculos){

                        if(marcaBuscar.equals(vehiculo.getMarca())){
                            System.out.println("Coche: " + vehiculo.getMarca() + " KM: " + vehiculo.getKilometro());
                        } else {
                            System.out.println("No se encuentra ese coche");
                        }
                    }

                } else{
                System.out.println("Opcion incorrecta");
            }
            }
        }

    }
