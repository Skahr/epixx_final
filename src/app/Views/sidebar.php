<div>
  <h2>Корзина</h2>
  <p>
    {% if session %}

        {% for k, v in session %}
          {{ k }}  -  {{ v }}
          <br />
        {% endfor %}

  {% endif %}


  </p>
  <p>
    <form action="" method="post">
      <input type="submit" name="clearcart" value="Очистить корзину">
    </form>
  </p>
</div>
