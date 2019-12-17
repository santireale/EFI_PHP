        <div class="section topics">
          <h2>Categorias</h2>
          <ul>
            <?php $resultsCategory = selectAllCategory();
            foreach ($resultsCategory as $row)
            {
            ?>
            <a href="postCategory.php?id=<?php echo $row['id'] ?>">
              <li><?php echo $row['nombre']?></li>
            </a>
            <?php
            }
            ?>
          </ul>
        </div>