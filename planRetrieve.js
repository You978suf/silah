
document.querySelector('.container').addEventListener('click', function(event) {
    if (event.target.tagName === 'BUTTON' && event.target.id.endsWith('_addToCart')) {     
        const priceColumn = event.target.parentNode;
        const planName = priceColumn.querySelector('p').textContent;
        const planPrice = parseFloat(priceColumn.querySelector('h3').textContent.replace('$', ''));
        sessionStorage.setItem('selectedPlan', planName);
        sessionStorage.setItem('selectedPrice', planPrice);
        window.location.href = 'checkout.html';
    }
});

// Pre-defined images for each plan
const images = {
    'Student': 'student_question.jpg',
    'Premium': 'premium_question.jpg',
    'Professional': 'professional_question.jpg'
};

// Function to display the question image and input box to the user
function displayQuestion() {
    const selectedPlan = sessionStorage.getItem('selectedPlan');
    const imageSrc = images[selectedPlan];
    
    // Create an image element
    const image = document.createElement('img');
    image.src = imageSrc;
    image.alt = 'Question Image';
    
    // Create a text input element
    const answerInput = document.createElement('input');
    answerInput.type = 'text';
    answerInput.placeholder = 'Your answer...';
    
    // Create a button for submitting the answer
    const submitButton = document.createElement('button');
    submitButton.textContent = 'Submit Answer';
    submitButton.onclick = function() {
        const answer = answerInput.value.toLowerCase(); // Convert answer to lowercase for case-insensitive comparison
        const correctAnswer = getCorrectAnswer(selectedPlan);
        
        // Check if the answer is correct
        if (answer === correctAnswer) {
            // Reduce the price by 10% for the Premium plan and 20% for the Student plan
            let discount = selectedPlan === 'Premium' ? 0.1 : (selectedPlan === 'Student' ? 0.2 : 0);
            const selectedPrice = parseFloat(sessionStorage.getItem('selectedPrice'));
            const newPrice = selectedPrice - (selectedPrice * discount);
            
            // Update the displayed price
            document.getElementById('selectedPrice').textContent = 'Price: $' + newPrice.toFixed(2);
        } else {
            alert('Incorrect answer. Please try again.');
        }
    };
    
    // Append the image, input box, and submit button to the DOM
    const container = document.getElementById('questionContainer');
    container.innerHTML = ''; // Clear any existing content
    container.appendChild(image);
    container.appendChild(answerInput);
    container.appendChild(submitButton);
}

// Function to retrieve the correct answer based on the plan
function getCorrectAnswer(plan) {
    switch (plan) {
        case 'Student':
            return '4'; // The correct answer to "What is 2 + 2?"
        case 'Premium':
            return '20'; // The correct answer to "What is 5 * 4?"
        case 'Professional':
            return ''; // No correct answer needed for the Professional plan
        default:
            return '';
    }
}

// Function to handle the "Get Discount" button click
function displayDiscountProblem() {
    displayQuestion();
}


