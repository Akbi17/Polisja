$(document).ready(function() {
  var images = $(".grid-container a");
  var infoBox = $(".information");
  var currentIndex = 0;
  var interval = 1000; // Zwiększono czas między obrótami
  var flippedAndInfoDuration = 4000; // Zmniejszono czas wyświetlania informacji
  var resetDuration = 4000; // Czas opóźnienia resetowania ikonki

  var timer;
  var isManualRotation = false;

  function showInfo(index) {
    var currentImage = images.eq(index).find("img");
    var title = currentImage.data("title");
    var content = currentImage.data("content");
    var iconHref = currentImage.parent().attr("href");

    infoBox.find(".info-title").text(title);
    infoBox.find(".info-content").text(content);
    infoBox.find(".info-button").attr("href", iconHref);

    if (!currentImage.hasClass("active")) {
      images.removeClass("active");
      rotateImage(currentImage);

      timer = setTimeout(function() {
        resetImage(currentImage);
        infoBox.fadeOut();
        if (!isManualRotation) {
          resumeAutomaticRotation();
        }
      }, flippedAndInfoDuration);
    }

    infoBox.fadeIn(500);
  }

  function rotateImage(image) {
    image.addClass("active");
    image.css({
      transform: "scale(1.05) rotateY(180deg)",
      boxShadow: "0 4px 8px rgba(0, 0, 0, 0.1)"
    });
  }

  function resetImage(image) {
    image.removeClass("active");
    image.css({
      transform: "scale(1) rotateY(0)",
      boxShadow: "none"
    });
  }

  function rotateNextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    showInfo(currentIndex);

    // Reset image after a delay
    setTimeout(function() {
      resetImage(images.eq(currentIndex).find("img"));
    }, resetDuration);
  }

  rotateNextImage();

  function resumeAutomaticRotation() {
    if (!isManualRotation) {
      timer = setTimeout(function() {
        rotateNextImage();
      }, interval);
    }
  }

  images.on("mouseenter", function() {
    if ($(this).find("img").hasClass("active")) {
      return;
    }

    isManualRotation = true;
    clearTimeout(timer);

    images.find("img").removeClass("active");
    resetImage(images.find("img"));
    $(this).find("img").addClass("active");
    rotateImage($(this).find("img"));
    showInfo(images.index(this));
  });

  images.on("mouseleave", function() {
    if ($(this).find("img").hasClass("active")) {
      return;
    }

    isManualRotation = false;
    clearTimeout(timer);
    resetImage(images.find("img"));
    setTimeout(function() {
      resumeAutomaticRotation();
    }, resumeRotationDelay);
  });

  $(".grid-container").on("mouseenter", function() {
    resumeAutomaticRotation();
  }).on("mouseleave", function() {
    if (!isManualRotation) {
      resumeAutomaticRotation();
    }
  });
});
