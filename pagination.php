<?php $numOfPages = ceil($total / $limit); ?>

<nav class="d-flex justify-content-center mt-5 mb-3">
  <ul class="pagination">
    <li class="page-item <?php if ($page == 1): ?>disabled<?php endif; ?>">
      <a class="page-link" href="products?category=<?= $category_id ?>&page=<?= $page - 1 ?>">&larr;</a>
    </li>
    <?php for ($i = 1; $i <= $numOfPages; $i++): ?>
      <li class="page-item <?php if ($page == $i): ?>active<?php endif; ?>"><a class="page-link" href="products?category=<?= $category_id ?>&page=<?= $i ?>"><?= $i ?></a></li>
    <?php endfor; ?>
    <li class="page-item <?php if ($page == $numOfPages): ?>disabled<?php endif; ?>">
      <a class="page-link" href="products?category=<?= $category_id ?>&page=<?= $page + 1 ?>">&rarr;</a>
    </li>
  </ul>
</nav>