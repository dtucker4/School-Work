#include "lab.h"
#define SIZE 100000
int main(void) {
	clock_t start, end;
	double bubbleTime, shellTime;
	int i, j;
	int arrShellSort[SIZE];
	int arrBubbleSort[SIZE];
	for (int i = 0; i < SIZE; i++) {
		arrShellSort[i] = rand() % 10000;
		arrBubbleSort[i] = arrShellSort[i];
	}

	start = clock();
	shellSort(arrShellSort, SIZE-1);
	end = clock();
	shellTime = (double)(end - start) / CLOCKS_PER_SEC;

	start = clock();
	bubbleSort(arrBubbleSort, SIZE-1);
	end = clock();
	bubbleTime = (double)(end - start) / CLOCKS_PER_SEC;
	
	
	printf("Size of array: %d \n\n", SIZE);
	
	printf("Shell sort \t Time: %f \n", shellTime);
	for (i = 0; i < 4; i++) {
		printf("%d ", arrShellSort[i]);
	}
	printf("...");
	for (j = SIZE - 4; j < SIZE; j++) {
		printf(" %d ", arrShellSort[j]);
	}
	puts(" ");
	puts(" ");
	printf("Bubble sort\t Time: %f \n", bubbleTime);
	for (i = 0; i < 4; i++) {
		printf("%d ", arrBubbleSort[i]);
	}
	printf("...");
	for (j = SIZE - 4; j < SIZE; j++) {
		printf(" %d ", arrBubbleSort[j]);
	}
	puts(" ");
	puts(" ");
	system("pause");
}