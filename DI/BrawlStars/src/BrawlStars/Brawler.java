package BrawlStars;

// clase padre, no se pueden crear brawlers "a secas", solo epicos o legendarios
public abstract class  Brawler {
    // datos que tienen todos los brawlers
   private String name;
   private int health;

    // constructor, lo usan las hijas con super()
    public Brawler(String name, int health) {
        this.name = name;
        this.health = health;
    }

    // getters para leer los datos desde fuera
    public String getName() {
        return name;
    }

    public int getHealth() {
        return health;
    }
    // formato [nombre:vida] que sale al listar y en el combate
    @Override
    public String toString() {
        return "[" + name +":"+ health +"]";
    }
    // quita vida (lo usa el legendario sobre el rival)
    public void reduceHealth(int damage){
        this.health -=damage;
    }
    // suma vida (lo usa el epico sobre si mismo)
    public void increaseHealth(int supply){
        this.health += supply;
    }
    // cada tipo de brawler hace su accion a su manera
    public abstract int actionByCategory(Brawler brawler);
}


