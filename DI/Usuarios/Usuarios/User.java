package examen;

import java.util.ArrayList;

public abstract class User {
    //Atributo
    private final String username;
    private final String password;

    //Constructor
    public User(String username, String password){
        this.username = username;
        this.password = password;
    }

    //GETTERS
    public String getUsername(){
        return username;
    }

    /**
     * Método para verificar si un usuario es correcto sin lanzar al exterior
     * la contraseña de la clase
     * @param username Nombre de usuario a intentar
     * @param password Contraseña a intentar
     * @return boolean Verdadero si es correcto, falso en caso contrario
     */
    public boolean verify(String username, String password){
        //Si el nombre de usuario de la clase (this.username) es igual al del parámetro (username)
        //Y
        //la contraseña de la clase (this.password) es igual a la del parámetro
        //Devuelve verdadero, falso en caso contrario
        return this.username.equals(username) && this.password.equals(password);
    }

    public abstract void actionByUserType(ArrayList<User> users);

}
