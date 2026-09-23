package BrawlStars;

// brawler epico: en vez de atacar se cura con sus suministros
public class Epico extends Brawler {
    // lo que se suma de vida en cada turno
    private int suplies;

    public Epico(String name, int health, int suplies) {
        // nombre y vida van al padre
        super(name, health);
        // los suministros se quedan aqui
        this.suplies = suplies;
    }

    // no usa al enemigo, solo se suma vida a el mismo
    @Override
    public int actionByCategory(Brawler enemy) {
        increaseHealth(suplies);
        System.out.println(this + " Increase health to " + getHealth());
        return getHealth();
    }
}



