/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */

// Tableau pour stocker les paramètres appliqués
var appliedSettings = [];

var $text_sm_body_checkbox,
  $text_sm_header_checkbox,
  $text_sm_sidebar_checkbox,
  $text_sm_footer_checkbox,
  $flat_sidebar_checkbox,
  $compact_sidebar_checkbox,
  $child_indent_sidebar_checkbox,
  $text_sm_brand_checkbox;

// Créez un objet pour stocker les IDs
var elementIds = {
  accentVariants: "yourAccentVariantsId",
  sidebarVariantsDark: "yourSidebarVariantsDarkId",
  sidebarVariantsLight: "yourSidebarVariantsLightId",
  logoVariants: "yourLogoVariantsId",
  variantsBarreNavigation: "yourVariantsBarreNavigationId",
};

var selectedSidebarLightColor = ""; // Variable pour stocker la couleur de la barre latérale sur blanc sélectionnée
var selectedLogoColor = ""; // Variable pour stocker la couleur de fond de logo sélectionnée
var selectedSidebarDarkColor = ""; // Variable pour stocker la couleur de la barre latérale sur blanc sélectionnée
var selectedVariantsBarreNavigation = "";
var selectedAccentColor = ""; // Variable pour stocker la couleur d'accent sélectionnée

var navbar_dark_skins = [
  "navbar-primary",
  "navbar-secondary",
  "navbar-info",
  "navbar-success",
  "navbar-danger",
  "navbar-indigo",
  "navbar-purple",
  "navbar-pink",
  "navbar-navy",
  "navbar-lightblue",
  "navbar-teal",
  "navbar-cyan",
  "navbar-dark",
  "navbar-gray-dark",
  "navbar-gray",
];

var navbar_light_skins = [
  "navbar-light",
  "navbar-warning",
  "navbar-white",
  "navbar-orange",
];

var sidebar_colors = [
  "bg-primary",
  "bg-warning",
  "bg-info",
  "bg-danger",
  "bg-success",
  "bg-indigo",
  "bg-lightblue",
  "bg-navy",
  "bg-purple",
  "bg-fuchsia",
  "bg-pink",
  "bg-maroon",
  "bg-orange",
  "bg-lime",
  "bg-teal",
  "bg-olive",
];

var accent_colors = [
  "accent-primary",
  "accent-warning",
  "accent-info",
  "accent-danger",
  "accent-success",
  "accent-indigo",
  "accent-lightblue",
  "accent-navy",
  "accent-purple",
  "accent-fuchsia",
  "accent-pink",
  "accent-maroon",
  "accent-orange",
  "accent-lime",
  "accent-teal",
  "accent-olive",
];

var sidebar_skins = [
  "sidebar-dark-primary",
  "sidebar-dark-warning",
  "sidebar-dark-info",
  "sidebar-dark-danger",
  "sidebar-dark-success",
  "sidebar-dark-indigo",
  "sidebar-dark-lightblue",
  "sidebar-dark-navy",
  "sidebar-dark-purple",
  "sidebar-dark-fuchsia",
  "sidebar-dark-pink",
  "sidebar-dark-maroon",
  "sidebar-dark-orange",
  "sidebar-dark-lime",
  "sidebar-dark-teal",
  "sidebar-dark-olive",
  "sidebar-light-primary",
  "sidebar-light-warning",
  "sidebar-light-info",
  "sidebar-light-danger",
  "sidebar-light-success",
  "sidebar-light-indigo",
  "sidebar-light-lightblue",
  "sidebar-light-navy",
  "sidebar-light-purple",
  "sidebar-light-fuchsia",
  "sidebar-light-pink",
  "sidebar-light-maroon",
  "sidebar-light-orange",
  "sidebar-light-lime",
  "sidebar-light-teal",
  "sidebar-light-olive",
];

(function ($) {
  "use strict";

  var $sidebar = $(".control-sidebar");
  var $container = $("<div />", {
    class: "p-3 control-sidebar-content",
  });

  // Ajoutez ces lignes pour définir une hauteur maximale et activer le défilement
  $container.css({
    "max-height": "500px", // Définissez la hauteur maximale que vous souhaitez
    "overflow-y": "auto", // Activez le défilement vertical si nécessaire
  });

  $sidebar.append($container);

  $container.append(
    '<h5>Personnaliser votre tableaux de bord</h5><hr class="mb-2"/>'
  );

  $container.append(
    '<button id="saveSettingsBtn" class="btn btn-primary">Sauvegarder</button>'
  );

  var $text_sm_body_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $("body").hasClass("text-sm"),
    class: "mr-1",
    id: "textSmBodyCheckbox", // Add this line to set the id
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $("body").addClass("text-sm");
    } else {
      $("body").removeClass("text-sm");
    }
  });

  var $text_sm_body_container = $("<div />", { class: "mb-1" })
    .append($text_sm_body_checkbox)
    .append("<span>Texte du corps en petit</span>");
  $container.append($text_sm_body_container);

  var initialCheckboxValue = $text_sm_body_checkbox.prop("checked");

  var $text_sm_header_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $(".main-header").hasClass("text-sm"),
    class: "mr-1",
    id: "textSmHeaderCheckbox", // Add this line to set the id
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $(".main-header").addClass("text-sm");
    } else {
      $(".main-header").removeClass("text-sm");
    }
  });
  var $text_sm_header_container = $("<div />", { class: "mb-1" })
    .append($text_sm_header_checkbox)
    .append("<span>Barre de navigation petit</span>");
  $container.append($text_sm_header_container);

  var $text_sm_sidebar_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $(".nav-sidebar").hasClass("text-sm"),
    class: "mr-1",
    id: "textSmSidebarCheckbox", // Add this line to set the id
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $(".nav-sidebar").addClass("text-sm");
    } else {
      $(".nav-sidebar").removeClass("text-sm");
    }
  });
  var $text_sm_sidebar_container = $("<div />", { class: "mb-1" })
    .append($text_sm_sidebar_checkbox)
    .append("<span>Texte barre latérale petit</span>");
  $container.append($text_sm_sidebar_container);

  var $text_sm_footer_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $(".main-footer").hasClass("text-sm"),
    class: "mr-1",
    id: "textSmFooterCheckbox", // Add this line to set the id
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $(".main-footer").addClass("text-sm");
    } else {
      $(".main-footer").removeClass("text-sm");
    }
  });
  var $text_sm_footer_container = $("<div />", { class: "mb-1" })
    .append($text_sm_footer_checkbox)
    .append("<span> Pied de page texte petit</span>");
  $container.append($text_sm_footer_container);

  var $flat_sidebar_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $(".nav-sidebar").hasClass("nav-flat"),
    class: "mr-1",
    id: "flatSidebarCheckbox", // Add this line to set the i
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $(".nav-sidebar").addClass("nav-flat");
    } else {
      $(".nav-sidebar").removeClass("nav-flat");
    }
  });
  var $flat_sidebar_container = $("<div />", { class: "mb-1" })
    .append($flat_sidebar_checkbox)
    .append("<span>Style plat barre latérale</span>");
  $container.append($flat_sidebar_container);

  var $compact_sidebar_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $(".nav-sidebar").hasClass("nav-compact"),
    class: "mr-1",
    id: "compactSidebarCheckbox", // Add this line to set the id
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $(".nav-sidebar").addClass("nav-compact");
    } else {
      $(".nav-sidebar").removeClass("nav-compact");
    }
  });
  var $compact_sidebar_container = $("<div />", { class: "mb-1" })
    .append($compact_sidebar_checkbox)
    .append("<span>Barre latérale Compacte</span>");
  $container.append($compact_sidebar_container);

  var $child_indent_sidebar_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $(".nav-sidebar").hasClass("nav-child-indent"),
    class: "mr-1",
    id: "childIndentSidebarCheckbox", // Add this line to set the id
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $(".nav-sidebar").addClass("nav-child-indent");
    } else {
      $(".nav-sidebar").removeClass("nav-child-indent");
    }
  });
  var $child_indent_sidebar_container = $("<div />", { class: "mb-1" })
    .append($child_indent_sidebar_checkbox)
    .append("<span>Indenté enfant barre latérale</span>");
  $container.append($child_indent_sidebar_container);

  var $text_sm_brand_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $(".brand-link").hasClass("text-sm"),
    class: "mr-1",
    id: "textSmBrandCheckbox", // Add this line to set the id
  }).on("click", function () {
    if ($(this).is(":checked")) {
      $(".brand-link").addClass("text-sm");
    } else {
      $(".brand-link").removeClass("text-sm");
    }
  });

  var $text_sm_brand_container = $("<div />", { class: "mb-4" })
    .append($text_sm_brand_checkbox)
    .append("<span>Logo texte petit </span>");
  $container.append($text_sm_brand_container);

  $container.append("<h6>Variantes de barre de navigation</h6>");

  var $navbar_variants = $("<div />", {
    class: "d-flex",
    id: elementIds.variantsBarreNavigation,
  });
  var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins);
  var $navbar_variants_colors = createSkinBlock(
    navbar_all_colors,
    function (e) {
      var color = $(this).data("color");
      var $main_header = $(".main-header");
      $main_header.removeClass("navbar-dark").removeClass("navbar-light");
      navbar_all_colors.map(function (color) {
        $main_header.removeClass(color);
      });

      if (navbar_dark_skins.indexOf(color) > -1) {
        $main_header.addClass("navbar-dark");
      } else {
        $main_header.addClass("navbar-light");
      }

      $main_header.addClass(color);
      selectedVariantsBarreNavigation = color;
    }
  );

  $navbar_variants.append($navbar_variants_colors);

  $container.append($navbar_variants);

  $container.append("<h6>Variantes de couleur d'accent</h6>");
  var $accent_variants = $("<div />", {
    class: "d-flex",
    id: elementIds.accentVariants,
  });
  $container.append($accent_variants);

  $container.append(
    createSkinBlock(accent_colors, function () {
      var color = $(this).data("color");
      var accent_class = color;
      var $body = $("body");
      accent_colors.map(function (skin) {
        $body.removeClass(skin);
      });

      $body.addClass(accent_class);

      // Stockez la couleur d'accent sélectionnée dans la variable
      selectedAccentColor = color;
    })
  );

  // alert("mmm");

  $container.append("<h6>Variante sélectionneur menu sur noir</h6>");
  var $sidebar_variants_dark = $("<div />", {
    class: "d-flex",
    id: elementIds.sidebarVariantsDark,
  });
  $container.append($sidebar_variants_dark);

  $container.append(
    createSkinBlock(sidebar_colors, function () {
      var color = $(this).data("color");
      var sidebar_class = "sidebar-dark-" + color.replace("bg-", "");
      var $sidebar = $(".main-sidebar");
      sidebar_skins.map(function (skin) {
        $sidebar.removeClass(skin);
      });

      $sidebar.addClass(sidebar_class);
      // Stockez la couleur sélectionnée dans la variable
      selectedSidebarDarkColor = color;
    })
  );

  $container.append("<h6>Variante sélectionneur menu sur blanc</h6>");
  var $sidebar_variants_light = $("<div />", {
    class: "d-flex",
    id: elementIds.sidebarVariantsLight,
  });
  $container.append($sidebar_variants_light);

  $container.append(
    createSkinBlock(sidebar_colors, function () {
      var color = $(this).data("color");
      var sidebar_class = "sidebar-light-" + color.replace("bg-", "");
      var $sidebar = $(".main-sidebar");
      sidebar_skins.map(function (skin) {
        $sidebar.removeClass(skin);
      });

      $sidebar.addClass(sidebar_class);
      // Stockez la couleur de la barre latérale sur blanc sélectionnée dans la variable
      selectedSidebarLightColor = color;
    })
  );

  var logo_skins = navbar_all_colors;
  $container.append("<h6>Variante fond logo</h6>");
  var $logo_variants = $("<div />", {
    class: "d-flex",
    id: elementIds.logoVariants,
  });
  $container.append($logo_variants);

  var $clear_btn = $("<a />", {
    href: "javascript:void(0)",
  })
    .text("clear")
    .on("click", function () {
      var $logo = $(".brand-link");
      logo_skins.map(function (skin) {
        $logo.removeClass(skin);
      });
    });
  $container.append(
    createSkinBlock(logo_skins, function () {
      var color = $(this).data("color");
      var $logo = $(".brand-link");
      logo_skins.map(function (skin) {
        $logo.removeClass(skin);
      });
      $logo.addClass(color);

      // Stockez la couleur de fond de logo sélectionnée dans la variable
      selectedLogoColor = color;
    }).append($clear_btn)
  );

  function createSkinBlock(colors, callback) {
    var $block = $("<div />", {
      class: "d-flex flex-wrap mb-3",
    });

    colors.forEach(function (color) {
      // Vérifiez si la couleur est définie
      if (color) {
        var colorClass =
          ((Array.isArray(color) ? color.join(" ") : color) || "")
            .replace("navbar-", "bg-")
            .replace("accent-", "bg-") + " elevation-2";

        var $color = $("<div />", {
          class: colorClass.trim(),
          "data-color": color, // Ajoutez cet attribut de données
        });

        $block.append($color);

        $color.data("color", color);

        $color.css({
          width: "40px",
          height: "20px",
          borderRadius: "25px",
          marginRight: 10,
          marginBottom: 10,
          opacity: 0.8,
          cursor: "pointer",
        });

        $color.hover(
          function () {
            $(this)
              .css({ opacity: 1 })
              .removeClass("elevation-2")
              .addClass("elevation-4");
          },
          function () {
            $(this)
              .css({ opacity: 0.8 })
              .removeClass("elevation-4")
              .addClass("elevation-2");
          }
        );

        if (callback) {
          $color.on("click", callback);
        }
      }
    });

    return $block;
  }

  $(".product-image-thumb").on("click", function () {
    const image_element = $(this).find("img");
    $(".product-image").prop("src", $(image_element).attr("src"));
    $(".product-image-thumb.active").removeClass("active");
    $(this).addClass("active");
  });
})(jQuery);

// Déclaration des variables pour les autres checkboxes

// Fonction pour collecter les sélections des checkboxes
function collectCheckboxSelections(checkboxSelector) {
  var selections = {};
  $(checkboxSelector).each(function () {
    var checkbox = $(this);
    var checkboxName = checkbox.data("setting");
    selections[checkboxName] = checkbox.prop("checked");
  });
  return selections;
}

// Fonction pour gérer l'envoi des données au serveur via AJAX
function sendSettingsToServer(settings) {
  $.ajax({
    method: "POST",
    url: "/sauvegarde_parametre",
    data: {
      settings: settings,
      _token: $('meta[name="csrf-token"]').attr("content"),
    },

    success: function (response) {
      console.log(response);
      alert("Paramètres sauvegardés avec succès!");
    },
    error: function (error) {
      console.error("jjj", error);
      // alert("Une erreur s'est produite lors de la sauvegarde des paramètres.");
    },
  });
}

// Gestion de l'événement de clic du bouton
$("#saveSettingsBtn").on("click", function () {
  // Array to store checkbox information
  var settingsToCollect = [
    { id: "textSmBodyCheckbox", selector: "body", class: "text-sm" },
    { id: "textSmHeaderCheckbox", selector: ".main-header", class: "text-sm" },
    { id: "textSmSidebarCheckbox", selector: ".nav-sidebar", class: "text-sm" },
    { id: "textSmFooterCheckbox", selector: ".main-footer", class: "text-sm" },
    { id: "flatSidebarCheckbox", selector: ".nav-sidebar", class: "nav-flat" },
    {
      id: "compactSidebarCheckbox",
      selector: ".nav-sidebar",
      class: "nav-compact",
    },
    {
      id: "childIndentSidebarCheckbox",
      selector: ".nav-sidebar",
      class: "nav-child-indent",
    },
    { id: "textSmBrandCheckbox", selector: ".brand-link", class: "text-sm" },
  ];

  // Object to store selected settings
  var selectedSettings = {};

  // Loop through checkboxes array
  settingsToCollect.forEach(function (checkboxInfo) {
    // Select the checkbox using its id
    var $checkbox = $("#" + checkboxInfo.id);

    // Get the current value of the checkbox
    var currentValue = $checkbox.prop("checked");

    // Log the current value
    console.log(checkboxInfo.id + ":", currentValue);

    // Modify the corresponding element based on the checkbox state
    if (currentValue) {
      $(checkboxInfo.selector).addClass(checkboxInfo.class);
    } else {
      $(checkboxInfo.selector).removeClass(checkboxInfo.class);
    }

    // Store the checkbox state in the selectedSettings object
    selectedSettings[checkboxInfo.id] = currentValue;
  }); // Loop through new elements array

  // Ajoutez la couleur sélectionnée à l'objet selectedSettings
  selectedSettings.sidebarDarkColor = selectedSidebarDarkColor;
  // Ajoutez la couleur d'accent sélectionnée à l'objet selectedSettings
  selectedSettings.accentColor = selectedAccentColor;

  selectedSettings.variantsBarreNavigation = selectedVariantsBarreNavigation;

  // Ajoutez la couleur de la barre latérale sur blanc sélectionnée à l'objet selectedSettings
  selectedSettings.sidebarLightColor = selectedSidebarLightColor;

  // Ajoutez la couleur de fond de logo sélectionnée à l'objet selectedSettings
  selectedSettings.logoColor = selectedLogoColor;

  // Send data to the server via AJAX
  sendSettingsToServer(selectedSettings);
});

// Fonction pour récupérer les paramètres de l'utilisateur depuis le serveur via AJAX
function getSettingsFromServer() {
  // Récupérez l'ID de l'utilisateur connecté (adaptez selon votre logique)
  var userId = document.head.querySelector('meta[name="user-id"]').content;

  $.ajax({
    method: "GET",
    url: "/get-settings",
    data: { user_id: userId },
    success: function (response) {
      // Appliquer les paramètres récupérés
      applySettings(response);
    },
    error: function (error) {
      console.error("Erreur lors de la récupération des paramètres.", error);
      
    },
  });
}

function applySettings(settings) {
  // Appliquer les paramètres des cases à cocher

  if (settings.textSmBodyCheckbox == "true") {
    $("#textSmBodyCheckbox").prop("checked", true);
    $("body").addClass("text-sm");
  } else {
    $("body").removeClass("text-sm");
  }

  // Appliquer les paramètres des cases à cocher
  if (settings.textSmHeaderCheckbox == "true") {
    $("#textSmHeaderCheckbox").prop("checked", true);
    $(".main-header").addClass("text-sm");
  } else {
    $(".main-header").removeClass("text-sm");
  }

  if (settings.textSmSidebarCheckbox == "true") {
    $("#textSmSidebarCheckbox").prop("checked", true);
    $(".nav-sidebar").addClass("text-sm");
  } else {
    $(".nav-sidebar").removeClass("text-sm");
  }

  if (settings.textSmFooterCheckbox == "true") {
    $("#textSmFooterCheckbox").prop("checked", true);
    $(".main-footer").addClass("text-sm");
  } else {
    $(".main-footer").removeClass("text-sm");
  }

  if (settings.flatSidebarCheckbox == "true") {
    $("#flatSidebarCheckbox").prop("checked", true);
    $(".nav-sidebar").addClass("nav-flat");
  } else {
    $(".nav-sidebar").removeClass("nav-flat");
  }

  if (settings.compactSidebarCheckbox == "true") {
    $("#compactSidebarCheckbox").prop("checked", true);
    $(".nav-sidebar").addClass("nav-compact");
  } else {
    $(".nav-sidebar").removeClass("nav-compact");
  }

  if (settings.childIndentSidebarCheckbox == "true") {
    $("#childIndentSidebarCheckbox").prop("checked", true);
    $(".nav-sidebar").addClass("nav-child-indent");
  } else {
    $(".nav-sidebar").removeClass("nav-child-indent");
  }

  if (settings.textSmBrandCheckbox == "true") {
    $("#textSmBrandCheckbox").prop("checked", true);
    $(".brand-link").addClass("text-sm");
  } else {
    $(".brand-link").removeClass("text-sm");
  }

  console.log("pppp", settings);
  // Appliquer les paramètres des couleurs de la barre latérale sur fond blanc
  if (settings.sidebarLightColor) {
    var color = settings.sidebarLightColor;
    var sidebar_class = "sidebar-light-" + color.replace("bg-", "");

    var $sidebar = $(".main-sidebar");
    sidebar_skins.map(function (skin) {
      $sidebar.removeClass(skin);
    });

    $sidebar.addClass(sidebar_class);
  }

  if (settings.sidebarDarkColor) {
    var color = settings.sidebarDarkColor;
    var sidebar_class = "sidebar-dark-" + color.replace("bg-", "");

    var $sidebar = $(".main-sidebar");
    sidebar_skins.map(function (skin) {
      $sidebar.removeClass(skin);
    });

    $sidebar.addClass(sidebar_class);
  }

  if (settings.accentColor) {
    var color = settings.accentColor;
    var $body = $("body");

    accent_colors.map(function (skin) {
      $body.removeClass(skin);
    });

    $body.addClass(color);
  }

  if (settings.variantsBarreNavigation) {
    var color = settings.variantsBarreNavigation;
    var navbar_all_colors = navbar_dark_skins.concat(navbar_light_skins);
    var $main_header = $(".main-header");
    $main_header.removeClass("navbar-dark").removeClass("navbar-light");
    navbar_all_colors.map(function (color) {
      $main_header.removeClass(color);
    });

    if (navbar_dark_skins.indexOf(color) > -1) {
      $main_header.addClass("navbar-dark");
    } else {
      $main_header.addClass("navbar-light");
    }

    $main_header.addClass(color);
  }

  if (settings.logoColor) {
    var logo_skins = navbar_all_colors;
    var color = settings.logoColor;
    var $logo = $(".brand-link");

    logo_skins.map(function (skin) {
      $logo.removeClass(skin);
    });

    $logo.addClass(color);
  }
}

// ...

// Initialisez la page en récupérant les paramètres de l'utilisateur depuis le serveur
$(document).ready(function () {
  getSettingsFromServer();
});
