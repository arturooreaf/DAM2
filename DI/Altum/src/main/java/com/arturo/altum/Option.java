package com.arturo.altum;

public class Option {
    private final String key;
    private final String value;

    public Option(String key, String value) {
        this.key = key;
        this.value = value;
    }

    public String getKey(){
        return key;
    }

    @Override
    public String toString(){
        return value;
    }
}