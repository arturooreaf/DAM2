package com.arturo.altum;

import atlantafx.base.theme.Dracula;
import atlantafx.base.theme.PrimerDark;
import atlantafx.base.theme.Theme;
import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Rectangle2D;
import javafx.scene.Scene;
import javafx.stage.Screen;
import javafx.stage.Stage;

import java.io.IOException;
import java.util.Locale;
import java.util.ResourceBundle;

public class MainApplication extends Application {
    @Override
    public void start(Stage stage) throws IOException {
        //Sets the theme
        Theme theme = new PrimerDark();
        Application.setUserAgentStylesheet(theme.getUserAgentStylesheet());

        //Sets the Lenguaje
        Locale locale = Locale.forLanguageTag("en-EN");
        ResourceBundle bundle = ResourceBundle.getBundle("i18n.messages", locale);
        FXMLLoader fxmlLoader = new FXMLLoader(MainApplication.class.getResource("main-view.fxml"), bundle);
        Scene scene = new Scene(fxmlLoader.load(), 600, 400);
        stage.setTitle("CALCULADORA");
        stage.setMaximized(false);
        stage.setScene(scene);
        stage.show();

        //Centrar en la pantalla
        Rectangle2D bounds = Screen.getPrimary().getVisualBounds();
        stage.setX((bounds.getWidth() - stage.getWidth()) /2);
        stage.setY((bounds.getHeight()- stage.getHeight()) / 2);
    }

    public static void main(String[] args) {
        launch();
    }
}