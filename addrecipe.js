function addIngredient() {
    const container = document.getElementById('ingredients-list');
    const row = document.createElement('div');
    row.className = 'dynamic-row';
    row.innerHTML = `
        <input type="text" name="ingredients[]" class="flex-3" placeholder="Ingredient name">
        <input type="text" name="qtys[]" class="flex-1" placeholder="Qty">
        <input type="text" name="units[]" class="flex-1" placeholder="Unit">
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">×</button>
    `;
    container.appendChild(row);
}

function addStep() {
    const container = document.getElementById('instructions-list');
    const stepCount = container.children.length + 1;
    const row = document.createElement('div');
    row.className = 'dynamic-row';
    row.innerHTML = `
        <span class="step-num">${stepCount}</span>
        <textarea name="steps[]" class="flex-grow" placeholder="Step instructions"></textarea>
        <button type="button" class="remove-btn" onclick="this.parentElement.remove()">×</button>
    `;
    container.appendChild(row);
}