import React from "react";
import {
    ColumnDef,
    flexRender,
    getCoreRowModel,
    useReactTable,
    getPaginationRowModel,
    getSortedRowModel,
    getFilteredRowModel,
    ColumnFiltersState,
    SortingState,
} from "@tanstack/react-table";
import {
    Table,
    TableBody,
    TableHead,
    TableRow,
    TableCell,
    TableHeader,
} from "@/components/ui/table";
import Pagination from "@/components/table/pagination";
import { Input } from "@/components/ui/input";
import { Button } from "../ui/button";

type DataTableProps<TData, TValue> = {
    columns: ColumnDef<TData>[];
    data: TData[];
    pagination?: any;
    additionalButton?: React.ReactNode;
};

function DataTable<TData, TValue>({ columns, data, pagination, additionalButton}: DataTableProps<TData, TValue>) {
    const [sorting, setSorting] = React.useState<SortingState>([]);
    const [columnFilters, setColumnFilters] = React.useState<ColumnFiltersState>([]);

    const table = useReactTable({
        columns,
        data,
        getCoreRowModel: getCoreRowModel(),
        getPaginationRowModel: getPaginationRowModel(),
        getSortedRowModel: getSortedRowModel(),
        getFilteredRowModel: getFilteredRowModel(),
        onColumnFiltersChange: setColumnFilters,
        onSortingChange: setSorting,
        state: {
            sorting,
            columnFilters,
        },
    });

    return (
        <div>
            <div className="flex item-center py-4 justify-between">
                {/* <Input
                    placeholder="Search Name..."
                    value={(table.getColumn("ward_name")?.getFilterValue() as string) ?? ""}
                    className="max-w-sm"
                    onChange={(event) =>
                        table.getColumn("ward_name")?.setFilterValue(event.target.value)
                    }
                /> */}
                {/* Add any additional buttons or actions here */}
                {additionalButton}
            </div>
            <div className="border rounded p-5">
                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id}>
                                {headerGroup.headers.map((header) => (
                                    <TableHead key={header.id}>
                                        {header.isPlaceholder
                                            ? null
                                            : flexRender(
                                                header.column.columnDef.header,
                                                header.getContext()
                                            )}
                                    </TableHead>
                                ))}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row) => (
                                <TableRow
                                    key={row.id}
                                    data-state={row.getIsSelected() ? "selected" : undefined}
                                >
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id}>
                                            {flexRender(cell.column.columnDef.cell, cell.getContext())}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow>
                                <TableCell colSpan={columns.length} className="h-24 text-center">
                                    No Results
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </div>

            {/* Only render Pagination if pagination prop is provided */}
            {pagination && Object.keys(pagination).length > 0 && (
                <Pagination table={table} pagination={pagination} />
            )}
        </div>
    );
}

export default DataTable;