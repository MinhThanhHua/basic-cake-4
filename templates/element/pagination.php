<?php
$this->Paginator->setTemplates([
    'prevActive' => '<li><a href={{url}}><i class="fas fa-chevron-left"></i></a></li>',
    'prevDisabled' => '<li class="btn-disabled"><a href={{url}}><i class="fas fa-chevron-left"></i></a></li>',
    'nextActive' => '<li><a href={{url}}><i class="fas fa-chevron-right"></i></a></li>',
    'nextDisabled' => '<li class="btn-disabled"><a href={{url}}><i class="fas fa-chevron-right"></i></a></li>',
    'number' => '<li><a href={{url}} >{{text}}</a></li>',
    'current' => '<li><a href={{url}} class="active-paginate">{{text}}</a></li>',
]);
?>

<div class="pagination-list pagination-custom">
    <ul>
        <?php
        $pageCount = $this->paginator->params()['pageCount'];
        $currentPage = $this->paginator->params()['page'];
        $this->Paginator->options(['url' => $this->request->getQuery()]);
        if ($pageCount > 1) {
            echo $this->Paginator->prev('Prev');
            echo $this->Paginator->numbers();
            echo $this->Paginator->next('Next');
        }
        ?>
    </ul>
</div>

<style>
    .active-paginate {
        background-color: #4472C4;
        color: #ffffff;
    }

    .table-list-item .pagination-list ul li {
        margin-left: 5px;
    }
</style>
