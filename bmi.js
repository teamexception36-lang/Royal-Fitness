function calculateBMI() {
  const height = parseFloat(document.getElementById("height").value);
  const weight = parseFloat(document.getElementById("weight").value);
  const result = document.getElementById("result");
  const suggestions = document.getElementById("suggestions");

  if (!height || !weight || height <= 0 || weight <= 0) {
    result.textContent = "⚠️ Please enter valid height and weight!";
    suggestions.innerHTML = "";
    return;
  }

  const bmi = (weight / ((height / 100) ** 2)).toFixed(1);
  let category = "";
  let advice = "";

  if (bmi < 18.5) {
    category = "Underweight";
    advice = `
      <strong>Diet Plan:</strong> Eat calorie-dense foods like nuts, whole milk, rice, bananas.<br>
      <strong>Exercise:</strong> Focus on light strength training and yoga to build muscle.
    `;
  } else if (bmi >= 18.5 && bmi < 24.9) {
    category = "Normal Weight";
    advice = `
      <strong>Diet Plan:</strong> Maintain balanced meals with proteins, carbs, and healthy fats.<br>
      <strong>Exercise:</strong> Mix cardio and strength training 4–5 times a week.
    `;
  } else if (bmi >= 25 && bmi < 29.9) {
    category = "Overweight";
    advice = `
      <strong>Diet Plan:</strong> Reduce sugars and fried foods, add fiber-rich meals.<br>
      <strong>Exercise:</strong> Include regular cardio (running, cycling) and light strength work.
    `;
  } else {
    category = "Obese";
    advice = `
      <strong>Diet Plan:</strong> Consult a nutritionist, focus on portion control, avoid processed foods.<br>
      <strong>Exercise:</strong> Start with walking, swimming, and gradually add resistance workouts.
    `;
  }

  result.innerHTML = `Your BMI is <strong>${bmi}</strong> — Category: <strong>${category}</strong>`;
  suggestions.innerHTML = advice;
}
