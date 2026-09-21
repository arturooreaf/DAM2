import java.util.ArrayList;


public class Main {
    static ArrayList<Brawler> brawlers;

    public static void main(String[] args) {


        brawlers = new ArrayList<>();
        Legendario neon = new Legendario("Neon", 8000);
        Legendario spike = new Legendario("Spike", 10000);

        Mitico tara = new Mitico("Tara", 7000);
        Mitico genio = new Mitico("Genio", 3000);
        Epico zer = new Epico("zer", 1000);

        brawlers = new ArrayList<>();
        brawlers.add(neon);
        brawlers.add(spike);
        brawlers.add(tara);
        brawlers.add(genio);
        brawlers.add(zer);


        for (Brawler i : brawlers) {
            i.atacar();

        }
    }
}