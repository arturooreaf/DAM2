package com.arturo.opciones;


import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.ChoiceBox;

import java.net.URL;
import java.util.ResourceBundle;

public class MainController implements Initializable {


    @FXML
    private ChoiceBox<String> choiceboxTheme;
    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
    choiceboxTheme.getItems().addAll("Dracula", "Nord (Light)", "Nord (Dark)");
    }
}