package intento1;

import java.util.ArrayList;

public abstract class User {
    private final String username;
    private final String password;

    public User(String username, String password) {
        this.username = username;
        this.password = password;
    }

    public String getUsername() {
        return username;
    }
    public  boolean verify(String username, String password){
        return this.username.equals(username) && this.password.equals(password);
    }

    public  abstract void   actionByCategory(ArrayList<User> users);

}
