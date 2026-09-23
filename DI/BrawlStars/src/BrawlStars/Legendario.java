package BrawlStars;

// brawler legendario: le quita vida al rival
public class Legendario extends Brawler {

    // lo que le quita al enemigo en cada ataque
private int damage;

    public Legendario(String name, int health, int damage) {
        // nombre y vida van al padre
        super(name, health);

        // el daño se queda aqui
        this.damage = damage;
    }


    // le resta su daño a la vida del enemigo
    @Override
    public int actionByCategory(Brawler enemy ) {
        enemy.reduceHealth(damage);
        System.out.println(this + " Apply -" + damage + " damage to " + enemy.getName());
        return getHealth();
    }
}
