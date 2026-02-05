filterSelection("all");
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function () {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}

// function setActiveButton(model) {
//   document.querySelectorAll("#myBtnContainer .btn").forEach((btn) => {
//     btn.classList.remove("active");
//     if (btn.dataset.model === model) {
//       btn.classList.add("active");
//     }
//   });
// }

window.addEventListener("DOMContentLoaded", () => {
  const hash = window.location.hash.replace("#", "") || "all";

  // Call your existing filter function
  filterSelection(hash);

  // Highlight the active button
  // setActiveButton(hash);

  // Make clicking update the active button and hash
  document.querySelectorAll("#myBtnContainer .btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const model = btn.dataset.model;
      filterSelection(model);
      document
        .querySelectorAll("#myBtnContainer .btn")
        .forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");
      // setActiveButton(model);
      history.replaceState(null, "", "#" + model);
    });
  });
});
