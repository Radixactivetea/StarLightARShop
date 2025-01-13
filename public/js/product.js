(function () {
  // Select all quantity containers (supports multiple items)
  const quantityContainers = document.querySelectorAll(".quantity");

  // Loop through each quantity container to add event listeners
  quantityContainers.forEach(quantityContainer => {
    const minusBtn = quantityContainer.querySelector(".minus");
    const plusBtn = quantityContainer.querySelector(".plus");
    const inputBox = quantityContainer.querySelector(".input-box");

    updateButtonStates();

    // Event listeners for button clicks and input change
    quantityContainer.addEventListener("click", handleButtonClick);
    inputBox.addEventListener("input", handleQuantityChange);

    // Function to update button states based on input value
    function updateButtonStates() {
      const value = parseInt(inputBox.value);
      minusBtn.disabled = value <= parseInt(inputBox.min);
      plusBtn.disabled = value >= parseInt(inputBox.max);
    }

    // Handle clicks on the minus or plus buttons
    function handleButtonClick(event) {
      if (event.target.classList.contains("minus")) {
        decreaseValue();
      } else if (event.target.classList.contains("plus")) {
        increaseValue();
      }
    }

    // Decrease value when minus button is clicked
    function decreaseValue() {
      let value = parseInt(inputBox.value);
      value = isNaN(value) ? 1 : Math.max(value - 1, parseInt(inputBox.min));
      inputBox.value = value;
      updateButtonStates();
      handleQuantityChange();
    }

    // Increase value when plus button is clicked
    function increaseValue() {
      let value = parseInt(inputBox.value);
      value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.max));
      inputBox.value = value;
      updateButtonStates();
      handleQuantityChange();
    }

    // Handle changes when the input box value is manually edited
    function handleQuantityChange() {
      let value = parseInt(inputBox.value);
      value = isNaN(value) ? 1 : value;

      // Execute code here based on the updated quantity value
      console.log("Quantity changed:", value);
    }
  });
})();