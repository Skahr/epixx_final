<div>
  <h2>Корзина</h2>
  <p>
    {% if session %}

        {% for i, row in session %}
          {% for key, value in row %}
        {{ key }} - {{ value }}
          {% endfor %}<br />
        {% endfor %}

  {% endif %}


  </p>
  <p>
    <form action="" method="post">
      <input type="submit" name="clearcart" value="Очистить корзину">
    </form>
  </p>
</div>
