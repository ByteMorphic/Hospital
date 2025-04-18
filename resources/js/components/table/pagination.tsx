import { Table } from "@tanstack/react-table";
import {
  ChevronLeft,
  ChevronRight,
  ChevronsLeft,
  ChevronsRight,
  MoreHorizontal,
} from "lucide-react";
import { Button } from "@/components/ui/button";
import { router } from '@inertiajs/react';

interface PaginationProps<TData> {
  table: Table<TData>;
  pagination: {
    current_page: number;
    last_page: number;
    total: number;
    per_page: number;
    from: number;
    to: number;
    links: Array<{
      url: string | null;
      label: string;
      active: boolean;
    }>;
    path: string;
  };
}

function Pagination<TData>({ table, pagination }: PaginationProps<TData>) {
  // Navigate to the specified URL
  const navigateToPage = (url: string | null) => {
    if (!url) return;
    router.get(url);
  };
  
  // Parse HTML entities in labels (for &laquo; etc.)
  const parseLabel = (label: string) => {
    const parser = new DOMParser();
    const dom = parser.parseFromString(`<!doctype html><body>${label}`, 'text/html');
    return dom.body.textContent || '';
  };

  // Generate page numbers with ellipses
  const getPageNumbers = () => {
    // Always show at most 7 items: first, last, current and neighbors, and ellipses
    const pageLinks = [];
    const totalPages = pagination.last_page;
    const currentPage = pagination.current_page;
    
    // Filter out the previous and next links
    const numberLinks = pagination.links.filter((link, index) => 
      index !== 0 && index !== pagination.links.length - 1
    );

    // Helper function to add a page button
    const addPageButton = (pageNumber: number, url: string | null) => {
      const isActive = pageNumber === currentPage;
      return (
        <Button
          key={`page-${pageNumber}`}
          variant={isActive ? "default" : "outline"}
          size="sm"
          className="h-8 w-8 p-0 hidden sm:inline-flex"
          onClick={() => navigateToPage(url)}
          disabled={!url}
        >
          {pageNumber}
        </Button>
      );
    };

    // Helper function to add ellipsis
    const addEllipsis = (key: string) => (
      <Button
        key={key}
        variant="outline"
        size="sm"
        className="h-8 w-8 p-0 hidden sm:inline-flex cursor-default"
        disabled
      >
        <MoreHorizontal className="h-4 w-4" />
      </Button>
    );
    
    // Always include first page
    if (numberLinks.length > 0) {
      pageLinks.push(addPageButton(1, numberLinks[0].url));
    }
    
    // Add ellipsis if needed before current page section
    if (currentPage > 3) {
      pageLinks.push(addEllipsis("start-ellipsis"));
    }
    
    // Add pages around current page
    for (let i = Math.max(2, currentPage - 1); i <= Math.min(totalPages - 1, currentPage + 1); i++) {
      if (i > 1 && i < totalPages) {
        const linkIndex = numberLinks.findIndex(link => link.label === i.toString());
        if (linkIndex !== -1) {
          pageLinks.push(addPageButton(i, numberLinks[linkIndex].url));
        }
      }
    }
    
    // Add ellipsis if needed after current page section
    if (currentPage < totalPages - 2) {
      pageLinks.push(addEllipsis("end-ellipsis"));
    }
    
    // Always include last page if it exists and is different from first page
    if (totalPages > 1 && numberLinks.length > 0) {
      pageLinks.push(addPageButton(totalPages, numberLinks[numberLinks.length - 1].url));
    }
    
    return pageLinks;
  };

  return (
    <div className="flex flex-col sm:flex-row items-center justify-between mt-6 mb-10 gap-4 sm:gap-6">
      {/* Total Results */}
      <div className="text-xs sm:text-sm text-muted-foreground">
        Showing <span className="font-medium">{pagination.from}</span> to{" "}
        <span className="font-medium">{pagination.to}</span> of{" "}
        <span className="font-medium">{pagination.total}</span> results
      </div>

      <div className="flex flex-wrap justify-center sm:justify-end items-center gap-4 sm:gap-6 w-full sm:w-auto">
        {/* Pagination Controls */}
        <div className="flex items-center space-x-1 sm:space-x-2">
          {/* First Page */}
          <Button
            variant="outline"
            size="sm"
            className="h-8 w-8 p-0"
            onClick={() => navigateToPage(pagination.links[1]?.url)} 
            disabled={pagination.current_page === 1}
          >
            <span className="sr-only">First page</span>
            <ChevronsLeft className="h-4 w-4" />
          </Button>
          
          {/* Previous Page */}
          <Button
            variant="outline"
            size="sm"
            className="h-8 w-8 p-0"
            onClick={() => navigateToPage(pagination.links[0]?.url)}
            disabled={pagination.current_page === 1}
          >
            <span className="sr-only">Previous page</span>
            <ChevronLeft className="h-4 w-4" />
          </Button>

          {/* Page Numbers with Ellipses */}
          <div className="flex items-center">
            {getPageNumbers()}
            <span className="text-xs px-2 sm:hidden">
              Page {pagination.current_page} of {pagination.last_page}
            </span>
          </div>

          {/* Next Page */}
          <Button
            variant="outline"
            size="sm"
            className="h-8 w-8 p-0"
            onClick={() => navigateToPage(pagination.links[pagination.links.length - 1]?.url)}
            disabled={pagination.current_page === pagination.last_page}
          >
            <span className="sr-only">Next page</span>
            <ChevronRight className="h-4 w-4" />
          </Button>
          
          {/* Last Page */}
          <Button
            variant="outline"
            size="sm"
            className="h-8 w-8 p-0"
            onClick={() => navigateToPage(pagination.links[pagination.links.length - 2]?.url)}
            disabled={pagination.current_page === pagination.last_page}
          >
            <span className="sr-only">Last page</span>
            <ChevronsRight className="h-4 w-4" />
          </Button>
        </div>
      </div>
    </div>
  );
}

export default Pagination;