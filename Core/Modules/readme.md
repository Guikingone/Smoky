# Smoky | Modules component

This component is the Modules component of Smoky, this one is used in order to perform simple et effective action inside the Modules.

# Introduction

Smoky is based around a multitude of component, this way, every component can live outside of the Smoky box, during development, Smoky has been made using multitude of PHP libraries and framework component.
Every component of Smoky can be use to your own need and can be "merged" into a bigger project at any moment. 

# Installation 

In order to use the Modules component of Smoky, you MUST use composer : 

```
composer require smoky-php/modules
````

Once the installation is done, you MUST use a new file call autoload.php with this content : 

```
<?php

$autoload = include __DIR__ . '/vendor/autoload.php";

return $autoload;

```

This way, you can access easily to all your dependencies though your application.

# Modules roles

The Module component is made for two principal things : 

- Take care of the functionality of your code
- Multiply the "open" face of your code and the reusability of this one.

This way, a Module can be used as a simple "bloc" of your code, by meaning this, you can use a Module in order to connect your application to a SMTP server of build a single page application, every Module is build to be "alone" et reusable without the others Modules.
The Module is linked to multiple Event and Listeners in order to be store into the ModulesManager, this way, the ModulesManager can store and retrieve the Modules in order to "push" them into the application, talking about the ModulesManager, what can you do with this one ?

# ModulesManager roles

The ModulesManager is made for multiple things : 

- Store the Modules
- Load the configuration of the Modules
- Push them into the application
- Link Events and Listeners to every Modules

Long story short, the ModulesManager is responsible for the "back" part of the Modules treatment, he can load the multiples configurations files, link Event and Listeners to the Modules and even, push them into the front part of every application, this way, the Modules Manager is the heart of your application.
By meaning this, we mean that the ModulesManager do a lot of things in order to be effective but don't misunderstand what we told, the ModulesManager ISN'T a framework itself, he's just a "brick" of the complete Smoky package and probably of YOUR framework.

# Testing 

In our politic of testing, we've made a complete package for testing this component, this way, we're sure of the quality of the code.

List of test result : 

- Modules Listener : 100% 
- Modules Events : 

# End word

We made this component to help you build the BEST application possible, this way, this component is tested and compiled during every commit, this way, we made what we call "A truly capable component", what we mean is that we truly believe in this component and on his quality, if by every mean, you find a bug or even a new way of using this component, be sure to take us on the breach and let us know what you found/build, this way, this component can grow and become better every time you use him.


