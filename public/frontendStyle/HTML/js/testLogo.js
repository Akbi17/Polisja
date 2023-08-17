$(document).ready(function() {
    var images = $(".grid-container img");
    var infoBox = $(".information");
    var currentIndex = 0;
    var interval = 4000; // Czas zmiany zdjęcia (4 sekundy)

    function showInfo(index) {
    var currentImage = images.eq(index);
    var text = currentImage.data("text");
    infoBox.text(text).fadeIn();

    if (!currentImage.hasClass("active")) {
        // Animacja powiększenia tylko dla jednego zdjęcia (bez hovera)
        images.removeClass("active").css("transform", "scale(1)");
        currentImage.addClass("active").css("transform", "scale(1.1)");
         

        // Po 3 sekundy zmniejszamy zdjęcie i ukrywamy informacje dodatkowe
        setTimeout(function() {
        currentImage.css("transform", "scale(1)");
        infoBox.fadeOut();
        }, 3000);
      
    }
    }
     // Zmiana obramowania na ciemniejszy kolor przy najechaniu myszką

    // Funkcja do obsługi efektu powiększenia przy najechaniu na zdjęcie
    images.on("mouseenter", function() {
    if (!$(this).hasClass("active")) {
        $(this).css("transform", "scale(1.1)");
        infoBox.text($(this).data("text")).fadeIn();
    }
    });

    images.on("mouseleave", function() {
    if (!$(this).hasClass("active")) {
        $(this).css("transform", "scale(1)");
        infoBox.hide();
    }
    });

    // Wywołujemy funkcję na początku dla pierwszego zdjęcia
    showInfo(currentIndex);

    // Ustawienie animacji na następne zdjęcie co 4 sekundy
    setInterval(function() {
    currentIndex = (currentIndex + 1) % images.length;
    showInfo(currentIndex);
    }, interval);
    });