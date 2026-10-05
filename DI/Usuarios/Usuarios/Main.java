package examen;

import java.util.ArrayList;

public class Main {

    private final static ArrayList<User> users = new ArrayList<>();

    public static void main(String[] args){
        //Lista de usuarios con valores por defecto
        users.add(new Admin("juan", "hola"));
        users.add(new Guest("fulano", "hola"));
        users.add(new Guest("mengano", "hola"));

        //Declaración de variables
        int opcion;
        String username, password;
        boolean userFound;

        //Por siempre
        while(true){
            //El trigger al inicio de cada ejecución está apagado
            userFound = false;

            //Imprime el menú y pide al usuario una opción
            System.out.println("1. Iniciar sesión\n2. Salir");
            opcion = Utils.readInteger("OPCIÓN: ");

            //SALIR DEL PROGRAMA
            if(opcion == 2){
                break;

            //INICIAR SESIÓN
            } else if(opcion == 1){
                //El usuario escribe unos datos a intentar
                username = Utils.readString("\nUSUARIO: ");
                password = Utils.readString("CONTRASEÑA: ");

                //Para cada usuario de los usuarios
                for(User user : users){
                    //Verifico los datos de este usuario si son correctos
                    if(user.verify(username, password)){
                        //Activa el trigger y ejecuta las acciones de ese usuario
                        userFound = true;
                        user.actionByUserType(users);

                        //Rompe el bucle para no seguir buscando usuarios
                        break;
                    }
                }

                //Si el usuario no es encontrado, lo notifica como error
                if(!userFound) System.out.println("Credenciales incorrectas");
            }

            //Salto de línea para la siguiente vez que se imprime el menu
            System.out.println();
        }
    }
}
