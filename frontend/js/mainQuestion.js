const apiUrl = "http://localhost:8000/backend/controllers/question.php";

fetch(apiUrl)
    .then(response => {
        if (!response.ok) {
            throw new Error("Failed to fetch data");
        }
        return response.json();
        })
        .then(data => {
        const faqContainer = document.querySelector('.faqs__container');

        data.forEach(question => {
            // Create the article element for each question
            const article = document.createElement('article');
            article.classList.add('faq');

            // Add the FAQ icon
            const faqIcon = document.createElement('div');
            faqIcon.classList.add('faq__icon');
            faqIcon.innerHTML = '<i class="uil uil-plus"></i>';
            article.appendChild(faqIcon);

            // Add the answers container
            const answersContainer = document.createElement('div');
            answersContainer.classList.add('question__answer');

            // Add the question text
            const questionTitle = document.createElement('h4');
            questionTitle.textContent = question.question_text;
            answersContainer.appendChild(questionTitle);

            // Add the answers
            const answerParagraph = document.createElement('p');
            if (question.answers && question.answers.length > 0) {
            question.answers.forEach(answer => {
                answerParagraph.innerHTML += `<b>${answer.department_name}</b>: ${answer.answer}<br>`;
            });
            } else {
            answerParagraph.innerHTML = 'No answers available for this question.';
            }
            answersContainer.appendChild(answerParagraph);

            // Initially hide the answers

            // Append the answers container to the article
            article.appendChild(answersContainer);

            // Append the article to the FAQ container
            faqContainer.appendChild(article);

            // Add toggle functionality for the FAQ icon
            faqIcon.addEventListener('click', () => {
            if (answerParagraph.style.display === 'none') {
                answerParagraph.style.display = 'block';
                faqIcon.innerHTML = '<i class="uil uil-minus"></i>'; // Change icon to minus
            } else {
                answerParagraph.style.display = 'none';
                faqIcon.innerHTML = '<i class="uil uil-plus"></i>'; // Change icon to plus
            }
            });
        });
    })
    .catch(error => {
        console.error("Error fetching data:", error);
        const faqContainer = document.querySelector('.faqs__container');
        faqContainer.innerHTML = '<p>Failed to load FAQs. Please try again later.</p>';
    });