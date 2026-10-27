package com.arturo.altum;

import atlantafx.base.theme.CupertinoDark;
import atlantafx.base.theme.CupertinoLight;
import atlantafx.base.theme.Dracula;
import atlantafx.base.theme.Theme;
import javafx.application.Application;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;

import java.net.URL;
import java.text.MessageFormat;
import java.util.ResourceBundle;

public class MainController implements Initializable {

    @FXML private Label labelTitle, labelResult;
    @FXML private TextField textfieldNumber1, textfieldNumber2;
    @FXML private ComboBox<Option> comboboxOperation, comboboxTheme;

    @FXML private Button buttonCalculate;



    private ResourceBundle bundle;

    @Override
    public void initialize(URL url, ResourceBundle resourceBundle) {
        bundle = resourceBundle;
        Option optionAdd = new Option("add", bundle.getString("option.add"));
        Option optionSubstract = new Option("substract", bundle.getString("option.substract"));
        Option optionMultiply = new Option("multiply", bundle.getString("option.multiply"));
        Option optionDivide = new Option("divide", bundle.getString("option.divide"));
        Option optionTheme1 = new Option("theme1", "CupertinoLight");
        Option optionTheme2 = new Option("theme2", "CupertinoDark");
        Option optionTheme3 = new Option("theme3", "Dracula");
        comboboxTheme.getItems().addAll(optionTheme1, optionTheme2, optionTheme3);
        comboboxTheme.valueProperty().addListener(observable->{
            Option newOption = comboboxTheme.getValue();
            Theme newTheme = switch (newOption.getKey()){
                case "theme1" -> new CupertinoLight();
                case "theme2" -> new CupertinoDark();
                case "theme3" -> new Dracula();
                default -> new CupertinoLight();
            };
            Application.setUserAgentStylesheet(newTheme.getUserAgentStylesheet());
        });

        labelTitle.requestFocus();

        comboboxOperation.getItems().addAll(optionAdd,optionSubstract,optionMultiply,optionDivide);

        //Escuchadores pendientes de cambios
        textfieldNumber1.textProperty().addListener(_ -> checkValues());
        textfieldNumber2.textProperty().addListener(_ -> checkValues());
        comboboxOperation.valueProperty().addListener(_->checkValues());

        buttonCalculate.setOnAction(_->{
            int number1 = Integer.parseInt(textfieldNumber1.getText()) ;
            int number2 = Integer.parseInt(textfieldNumber2.getText()) ;
            String operation = comboboxOperation.getValue().getKey();

            int resultado = switch (operation){
              case "add"            -> number1 + number2;
              case "substract"      -> number1 - number2;
              case "multiply"       -> number1 * number2;
              case "divide"         -> number1 / number2;
              default               ->  0;
            };

            labelResult.setText(MessageFormat.format(bundle.getString("label.result") ,resultado));
        });
    }
    private void checkValues(){
        boolean validCombo = comboboxOperation.getValue() != null;
        boolean validTextField = false;

        try {
            Integer.parseInt(textfieldNumber1.getText());
            Integer.parseInt(textfieldNumber2.getText());

            validTextField = true;
        }catch (Exception _ ){
        }
        buttonCalculate.setDisable(!(validCombo && validTextField));
    }
}