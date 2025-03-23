//js код удаления залов
document.addEventListener("DOMContentLoaded", function() {
    const token = document.head.querySelector('meta[name="csrf-token"]')?.content;
    
    if (token) {
        const buttonsDeleteHall = Array.from(document.querySelectorAll('.conf-step__button-trash'));
        buttonsDeleteHall.forEach(button => button.addEventListener('click', async () => {
            const hallId = button.dataset.hallId;
            const closestLi = button.closest('li');
            
            try {
                const response = await fetch('/delete-hall', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token, // Здесь используем токен из метатега
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ hall_id: hallId })
                });
                
                if (!response.ok) {
                    throw new Error('Ошибка при удалении зала');
                }
                
                const data = await response.json();
                console.log(data.message);
                closestLi.remove(); // Удаляем элемент из DOM
            } catch (error) {
                alert('Ошибка при удалении зала');
                console.error(error);
            }
        }));
    }
});