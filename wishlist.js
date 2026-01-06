
document.addEventListener('DOMContentLoaded', () => {
    fetch('fetch_wishlist.php')
        .then(res => res.json())
        .then(data => renderCards(data));
});

function renderCards(recipes) {
    const grid = document.getElementById('recipeGrid');
    grid.innerHTML = recipes.map(recipe => `
        <div class="recipe-card">
            <div class="card-header">
                <h3>${recipe.title}</h3>
                <i class="ph-fill ph-heart" style="color: #ff4d4d"></i>
            </div>
            <p>${recipe.desc}</p>
            <div class="card-meta">
                <span><i class="ph ph-clock"></i> ${recipe.time}</span>
                <span><i class="ph ph-users"></i> ${recipe.servings}</span>
            </div>
            <div class="card-tags">
                ${recipe.tags.map(t => `<span class="tag">${t}</span>`).join('')}
            </div>
            <div class="card-footer">
                <span><i class="ph ph-bowl-food"></i> ${recipe.ingredients}</span>
                <div style="display:flex; gap:10px; margin-top:15px;">
                    <button class="btn-view"><i class="ph ph-eye"></i> View Recipe</button>
                    <button class="btn-delete"><i class="ph ph-trash"></i></button>
                </div>
            </div>
        </div>
    `).join('');
    fetch('api.php?action=fetch')
    fetch('api.php?action=delete&id=' + recipeId)
}