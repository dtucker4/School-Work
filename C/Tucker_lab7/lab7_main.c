#include "lab7.h"

int main(void) {
	HEAP* heap;
	const int size = 100;
	int* arr;
	int dataPtr;
	int dataPtr2 = (void**)malloc(sizeof(int));
	bool result;
	arr = createArray(size);
	heap = heapCreate(size, compareInt);
	puts("Array before sorting: ");
	for (int i = 0; i <= size - 1; i++) {
			printf("%d ", arr[i]);
	}
	
	printf("\n\n\n");
	//BUILD HEAP
	for (int i = 0; i <= size; i++) {
		dataPtr = arr[i];
		result = heapInsert(heap, dataPtr);
		if (!result) {
			printf("Error inserting into heap\n");
			exit(101);
		}
	}
	//SORT and PRINT HEAP USING HEAP DELETE
	puts("Array after sorting ");
	for (int i = 0; i <= size-1; i++) {
		if (heapDelete(heap, dataPtr2))
			printf("%d ", *(int*)dataPtr2);
	}
	system("pause");
}